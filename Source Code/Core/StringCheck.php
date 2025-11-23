<?php

/**
 * ReportFormatter
 * Handles input validation, version checking, and string sanitization
 * for the anti-cheat report.
 */
class ReportFormatter
{
    // Allowed Launcher User-Agent Substrings
    private const ALLOWED_LAUNCHERS = [
        'GameLauncher',
        'LegacyLauncher',
        'SBRW Launcher',
        'SBRW Simple Launcher'
    ];

    // Characters forbidden in Usernames
    private const FORBIDDEN_CHARS = ['†', '?', '¤'];

    /**
     * Checks if the User-Agent string corresponds to an allowed launcher.
     */
    public static function isLauncherAllowed(?string $userAgent, bool $debug = false): bool
    {
        if (empty($userAgent)) {
            return false;
        }

        if ($debug) {
            return true;
        }

        foreach (self::ALLOWED_LAUNCHERS as $launcher) {
            if (strpos($userAgent, $launcher) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Analyzes the launcher version to determine if cheats were prevented.
     * Note: This logic relies on legacy version strings.
     */
    public static function getLauncherStatus(string $userAgent): string
    {
        $parts = explode(" ", $userAgent);
        $version = $parts[1] ?? '0.0.0.0'; // Default if version missing

        // Logic for GameLauncher
        if (strpos($userAgent, 'GameLauncher') !== false) {
            if (version_compare($version, '2.1.6.6', "<=")) {
                return "*Launcher Did Not Prevent Cheats for this User*";
            }
            if (version_compare($version, '2.1.7.8', "<=") || version_compare($version, '3.1.7.7', "==")) {
                return "*Launcher Prevented Cheats for this User*";
            }
            // Newer versions (Alert Level 2)
            return "**Launcher Prevented Cheats for this User**"; 
        }

        // Logic for SBRW Launcher (Offset index by 1 due to space in name "SBRW Launcher")
        if (strpos($userAgent, 'SBRW Launcher') !== false) {
            $version = $parts[2] ?? '0.0.0.0';
            if (version_compare($version, '2.1.7.8', "<=") || version_compare($version, '3.1.7.7', "==")) {
                return "*Launcher Prevented Cheats for this User*";
            }
             // Newer versions (Alert Level 2)
             return "**Launcher Prevented Cheats for this User**";
        }

        return "Unknown Launcher Status";
    }

    /**
     * Sanitizes and Formats specific report fields based on their type.
     */
    public static function formatField(string $fieldType, $value, bool $debug = false): ?string
    {
        // 1. Handle Debug Mode for Sensitive Fields
        // In debug mode, we hide HWID/IPs unless it is specifically an error
        if ($debug && in_array($fieldType, ['HWID', 'IP-Address'])) {
            return "||HIDDEN||";
        }

        // 2. Handle Empty/Null Values
        if (empty($value)) {
            switch ($fieldType) {
                case 'Operating-System':
                    return "**OPERATING SYSTEM**\nNo Information Provided";
                case 'Operating-Version':
                    return null; // Skip this field entirely
                case 'Event-Status':
                    return 'COMPLETED';
                case 'Internal-Error':
                    return "No Base Exception Provided";
                default:
                    return "No {$fieldType} Provided";
            }
        }

        // 3. Handle Specific Field Formatting
        switch ($fieldType) {
            case 'Internal-Error':
                return "Base Exception: " . $value;
            
            case 'Car-ID':
            case 'Discord-ID':
            case 'Hash':
            case 'Key':
                // Wrap these technical fields in code blocks
                return "```" . $value . "```";
            
            case 'Operating-System':
                return "**OPERATING SYSTEM**\n" . $value;

            case 'HWID':
                // Check for valid HWID format (Basic length check based on legacy code)
                if (strlen($value) > 30) { 
                    return "||" . $value . "||";
                }
                return "Invalid HWID";

            default:
                // Default sensitive fields (like IP) get spoiler tags
                return "||" . $value . "||";
        }
    }

    /**
     * Removes forbidden characters from usernames.
     */
    public static function sanitizeUserName(string $username): string
    {
        if (empty($username)) {
            return 'Unknown User';
        }

        // Convert forbidden chars to correct encoding if necessary, or just strip them
        $cleanName = $username;
        foreach (self::FORBIDDEN_CHARS as $char) {
            // Using utf8_encode to match legacy behavior if input encoding was inconsistent
            $target = utf8_encode($char); 
            $cleanName = str_replace($target, '', $cleanName);
        }

        return $cleanName;
    }
}

/* -------------------------------------------------------------------------
 * Legacy Wrapper Functions
 * -------------------------------------------------------------------------
 * Maintains backward compatibility with index.php
 */

function LauncherAllowList($string, $debug = false) 
{
    return ReportFormatter::isLauncherAllowed($string, $debug);
}

function AlertStatusReportVersion($string, $debug = false)
{
    return ReportFormatter::getLauncherStatus($string);
}

function CheckProvidedValue($type, $value, $debug = false)
{
    return ReportFormatter::formatField($type, $value, $debug);
}

function CheckUserName($string) 
{        
    return ReportFormatter::sanitizeUserName($string);
}
?>