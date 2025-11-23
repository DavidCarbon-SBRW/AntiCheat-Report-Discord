<?php

/**
 * PayloadBuilder
 * Assembles the Discord Webhook JSON arrays for different report types.
 */
class PayloadBuilder
{
    /**
     * Colors for Discord Embeds (Decimal)
     */
    private const COLOR_RED = 16711680;
    private const COLOR_ORANGE = 16753920;
    private const COLOR_GREEN = 65280;
    private const COLOR_GREY = 9807270;

    /**
     * Builds the main Anti-Cheat Detection Report.
     */
    public static function createCheatReport(
        string $serverIp,
        string $eventId,
        string $cheatCode,
        string $carId,
        string $hwid,
        string $discordId,
        string $launcherHash,
        string $launcherKey,
        string $userAgent,
        string $osName,
        string $osVersion, // Often unused or part of OS Name logic
        string $internalError,
        string $footerText,
        string $appVersion,
        bool $isDevMode
    ): array {
        // 1. Resolve Data using our new Registries
        $serverConfig = ServerRegistry::get($serverIp);
        $eventName    = EventRegistry::getName((int)$eventId, ServerRegistry::EventListLink($serverIp));
        $eventImage   = EventRegistry::getImage((int)$eventId, ServerRegistry::EventListLink($serverIp));
        $cheatName    = CheatRegistry::resolve($cheatCode);
        
        // 2. Resolve Dynamic Links/Images
        $authorName   = $serverConfig['profile_name'];
        $authorIcon   = ServerRegistry::getBaseIconUrl() . $serverConfig['icon'];
        $footerIcon   = $authorIcon; // Often matches the author
        
        // 3. Determine Status/Color based on Launcher Version logic
        $launcherStatus = ReportFormatter::getLauncherStatus($userAgent);
        $embedColor = self::determineColor($userAgent);

        // 4. Build Fields
        $fields = [
            [
                "name"   => "USER AGENT",
                "value"  => "```{$userAgent}```\n{$launcherStatus}",
                "inline" => false
            ],
            [
                "name"   => "SERVER / EVENT INFO",
                "value"  => "**Server:** " . $serverConfig['name'] . "\n**Event:** " . $eventName,
                "inline" => false
            ],
            [
                "name"   => "VIOLATION / CHEAT DETECTED",
                "value"  => "**{$cheatName}**",
                "inline" => false
            ],
            [
                "name"   => "CAR ID",
                "value"  => ReportFormatter::formatField("Car-ID", $carId, $isDevMode),
                "inline" => false
            ],
            [
                "name"   => "HARDWARE ID",
                "value"  => ReportFormatter::formatField("HWID", $hwid, $isDevMode),
                "inline" => false
            ],
            [
                "name"   => "DISCORD CLIENT ID",
                "value"  => ReportFormatter::formatField("Discord-ID", $discordId, $isDevMode),
                "inline" => false
            ],
            [
                "name"   => "LAUNCHER HASH",
                "value"  => ReportFormatter::formatField("Hash", $launcherHash, $isDevMode),
                "inline" => false
            ],
            [
                "name"   => "LAUNCHER HANDSHAKE",
                "value"  => ReportFormatter::formatField("Key", $launcherKey, $isDevMode),
                "inline" => false
            ],
            [
                "name"   => "OPERATING SYSTEM",
                "value"  => ReportFormatter::formatField("Operating-System", $osName, $isDevMode),
                "inline" => false
            ]
        ];

        // Add Internal Error field only if relevant
        if (!empty($internalError) && $internalError !== '0') {
            $fields[] = [
                "name"   => "INTERNAL ERROR MESSAGE",
                "value"  => ReportFormatter::formatField("Internal-Error", $internalError, $isDevMode),
                "inline" => false
            ];
        }

        // 5. Construct Final Array
        return [
            "username"   => $authorName,
            "avatar_url" => $authorIcon,
            "embeds"     => [
                [
                    "title"       => "Anti-Cheat Report",
                    "type"        => "rich",
                    "url"         => $serverConfig['site'],
                    "color"       => $embedColor,
                    "thumbnail"   => ["url" => $eventImage],
                    "footer"      => [
                        "text"     => "{$footerText} | Build: {$appVersion}",
                        "icon_url" => $footerIcon
                    ],
                    "fields"      => $fields
                ]
            ]
        ];
    }

    /**
     * Builds a System Alert (e.g., for Launcher Updates or Maintenance).
     */
    public static function createSystemAlert(
        string $serverIp,
        string $versionInfo,
        string $changelog,
        string $footerText,
        string $appVersion,
        bool $isDevMode
    ): array {
        $serverConfig = ServerRegistry::get($serverIp);
        $authorName   = $serverConfig['profile_name'];
        $authorIcon   = ServerRegistry::getBaseIconUrl() . $serverConfig['icon'];

        return [
            "username"   => $authorName,
            "avatar_url" => $authorIcon,
            "embeds"     => [
                [
                    "title"       => "System Alert / Update",
                    "type"        => "rich",
                    "description" => $changelog,
                    "url"         => $serverConfig['site'],
                    "color"       => self::COLOR_ORANGE, // Orange for alerts
                    "footer"      => [
                        "text"     => "{$footerText} | Build: {$appVersion}",
                        "icon_url" => $authorIcon
                    ],
                    "fields"      => [
                        [
                            "name"   => "VERSION INFO",
                            "value"  => $versionInfo,
                            "inline" => false
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * Determines the embed color based on launcher version/severity.
     */
    private static function determineColor(string $userAgent): int
    {
        // Use the Formatter logic to check if allowed
        if (ReportFormatter::isLauncherAllowed($userAgent)) {
            // Check specific versions for "Warning" vs "Good"
            // This mirrors the logic from the old FailSafeReportVersionFormat
            if (strpos($userAgent, '2.1.6.6') !== false) {
                 return self::COLOR_RED; // Old/Bad version
            }
            return self::COLOR_GREEN; // Valid
        }

        return self::COLOR_GREY; // Unknown/Generic
    }
}

/* -------------------------------------------------------------------------
 * Legacy Wrapper Functions
 * -------------------------------------------------------------------------
 * These match the function signatures expected by index.php
 */

function FailSafeReportVersionFormat($string, $debug = false, $debug_version = 0)
{
        try
    {
        if(strpos($string, 'GameLauncher') !== false)
        {
                $version_split = explode(" ", $string);
                /* Version 1 */
                if(version_compare($version_split[1], '2.1.7.8', "<=") || version_compare($version_split[1], '3.1.7.7', "=="))
                {
                    return 1;
                }
                /* Version 2 */
                elseif(version_compare($version_split[1], '2.1.8.8', "<="))
                {
                    return 2;
                }
                /* Version 3 */
                elseif(version_compare($version_split[1], '2.1.9.0002', "<="))
                {
                    return 3;
                }
                /* Version 4 */
                else
                {
                    return 4;
                }
        }
        elseif(strpos($string, 'SBRW Launcher') !== false)
        {
                $version_split = explode(" ", $string);
                /* Version 1 */
                if(version_compare($version_split[2], '2.1.7.8', "<=") || version_compare($version_split[2], '3.1.7.7', "=="))
                {
                    return 1;
                }
                /* Version 2 */
                elseif(version_compare($version_split[2], '2.1.8.8', "<="))
                {
                    return 2;
                }
                /* Version 3 */
                elseif(version_compare($version_split[2], '2.1.9.0002', "<="))
                {
                    return 3;
                }
                /* Version 4 */
                else
                {
                    return 4;
                }
        }
        elseif(strpos($string, 'LegacyLauncher') !== false)
        {
            $version_split = explode(" ", $string);
            if(count($version_split) > 0)
            {
                $version_split = explode(" ", $string);
                /* Version -1 */
                if(version_compare($version_split[1], '1.0.5.0', "<="))
                {
                    return -1;
                }
                /* Version 1 */
                else
                {
                    return 1;
                }
            }
            /* Version -1 */
            else
            {
                return -1;
            }
        }
        elseif($debug == true)
        {
            /* Version (Custom) */
            return $debug_version;
        }
        else
        {
            /* Version -1 */
            return -1;
        }
    }
    catch (Exception $on_the_fly_error)
    {
        if($debug == true)
        {
            /* Version (Custom) */
            return $debug_version;
        }
        else
        {
            /* Version -1 */
            return -1;
        }
    }
}

/*
 * The main report formatting function called by index.php
 * Note: The argument list is long, matching the snippet you provided.
 */
function Json_Format_Version_One(
    $serverIp, $eventId, $cheatCode, $carId, $hwid, $discordId, 
    $launcherHash, $launcherKey, $userAgent, $osName, $osVersion, 
    $internalError, $footerText, $appVersion, $isDevMode
) {
    return PayloadBuilder::createCheatReport(
        $serverIp, $eventId, $cheatCode, $carId, $hwid, $discordId, 
        $launcherHash, $launcherKey, $userAgent, $osName, $osVersion, 
        $internalError, $footerText, $appVersion, $isDevMode
    );
}

/*
 * The alert formatting function called by index.php
 */
function Json_Format_Version_Alert_One(
    $serverIp, $futureVersion, $changelog, $footerText, $appVersion, $isDevMode
) {
    return PayloadBuilder::createSystemAlert(
        $serverIp, $futureVersion, $changelog, $footerText, $appVersion, $isDevMode
    );
}
?>