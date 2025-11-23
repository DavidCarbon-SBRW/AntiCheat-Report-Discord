<?php

// Load the refactored core libraries
require_once __DIR__ . '/Core/CheatList.php';
require_once __DIR__ . '/Core/ServerList.php';
require_once __DIR__ . '/Core/StringCheck.php';
require_once __DIR__ . '/Core/EventNameCheck.php';
require_once __DIR__ . '/Core/JsonArrayCreator.php';

/**
 * ReportController
 * The main entry point for handling Anti-Cheat reports.
 */
class ReportController
{
    private const VERSION = "2.8.0-Refactored";
    private const FOOTER_TEXT = "Anti-Cheat Reporter";
    
    // Set to true to bypass launcher checks and show sensitive data
    private $isDevMode = false;

    public function handleRequest()
    {
        // 1. Parse Parameters
        // We preserve the legacy URL parsing logic to maintain compatibility with the launcher
        $params = $this->parseParams();

        if (empty($params)) {
            $this->sendResponse(400, "Invalid Request: No parameters found.");
            return;
        }

        // 2. Validate User Agent / Launcher
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        
        if (!ReportFormatter::isLauncherAllowed($userAgent, $this->isDevMode)) {
            $this->sendResponse(403, "Access Denied: Unrecognized Launcher.");
            return;
        }

        // 3. Determine Report Type and Build Payload
        $payload = null;
        $reportFormat = (int)($params['report_format'] ?? 0);
        $useAlertFormat = filter_var($params['use_alert'] ?? false, FILTER_VALIDATE_BOOLEAN);

        try {
            if ($useAlertFormat) {
                // Handle System Alerts (Maintenance, Updates)
                $payload = PayloadBuilder::createSystemAlert(
                    $params['serverip'] ?? '',
                    $params['future_version'] ?? 'Unknown',
                    $params['changelog'] ?? 'No Details',
                    self::FOOTER_TEXT,
                    self::VERSION,
                    $this->isDevMode
                );
            } else {
                // Handle Cheat Detection Reports
                $payload = PayloadBuilder::createCheatReport(
                    $params['serverip'] ?? '',
                    $params['event_id'] ?? 0,
                    $params['cheat_type'] ?? 0,
                    $params['car_used'] ?? '',
                    $params['hwid'] ?? '',
                    $params['discord_user_id'] ?? '',
                    $params['launcher_hash'] ?? '',
                    $params['launcher_certificate'] ?? '',
                    $userAgent,
                    $params['os_platform'] ?? '',
                    $_SERVER['HTTP_OS_VERSION'] ?? '', // Sometimes passed as header
                    $params['ac_ie'] ?? '', // Internal Error Code
                    self::FOOTER_TEXT,
                    self::VERSION,
                    $this->isDevMode
                );
            }
        } catch (Exception $e) {
            $this->sendResponse(500, "Internal Error: " . $e->getMessage());
            return;
        }

        // 4. Retrieve Webhook URL
        // If reportFormat is negative, it indicates a request for the "Separate" channel
        $serverConfig = ServerRegistry::get($params['serverip'] ?? '');
        $webhookUrl = ($reportFormat < 0) 
            ? $serverConfig['webhooks']['separate'] 
            : $serverConfig['webhooks']['normal'];

        if (empty($webhookUrl)) {
            $this->sendResponse(500, "Configuration Error: No Webhook URL found for this server.");
            return;
        }

        // 5. Send to Discord
        $success = $this->sendWebhook($webhookUrl, $payload);

        if ($success) {
            $this->sendResponse(200, "Report sent successfully.");
        } else {
            $this->sendResponse(502, "Failed to send report to Discord.");
        }
    }

    /**
     * Preserves the specific legacy URL parsing required by the client.
     */
    private function parseParams(): array
    {
        $currentUrl = sprintf(
            "%s://%s%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            $_SERVER['REQUEST_URI']
        );

        $components = parse_url($currentUrl);
        
        if (!isset($components['query'])) {
            return [];
        }

        $params = [];
        // The client might send query strings that need utf8 encoding before parsing
        parse_str(utf8_encode($components['query']), $params);

        return $params;
    }

    /**
     * Encapsulates the cURL logic.
     */
    private function sendWebhook(string $url, array $jsonPayload): bool
    {
        $ch = curl_init();
        
        $jsonData = json_encode($jsonPayload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $jsonData,
            CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => true
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Discord returns 204 No Content on success
        return ($httpCode >= 200 && $httpCode < 300);
    }

    private function sendResponse(int $code, string $message)
    {
        http_response_code($code);
        echo $message;
    }
}

// Execute Controller
$controller = new ReportController();
$controller->handleRequest();

?>