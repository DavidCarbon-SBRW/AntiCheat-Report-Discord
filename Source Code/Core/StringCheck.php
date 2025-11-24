<?php
/**
 * StringChecker
 * Handles input validation, version checking, and string sanitization
 * for the anti-cheat report.
 */
class StringChecker
{
    // Allowed Launcher User-Agent Substrings
    private const ALLOWED_LAUNCHERS = [
        'GameLauncher',
        'LegacyLauncher',
        'SBRW Launcher',
        'SBRW Simple Launcher'
    ];

    // Characters forbidden in Usernames
    private const FORBIDDEN_CHARS = ['†', '?', '¤', '[S]'];

    /**
     * Checks if the User-Agent string corresponds to an allowed launcher.
     */
    public static function isLauncherAllowed(?string $userAgent, bool $debug = false): bool
    {
        if (empty($userAgent)) 
        {
            return false;
        }
        else if ($debug) 
        {
            return true;
        }

        foreach (self::ALLOWED_LAUNCHERS as $launcher) 
        {
            if (strpos($userAgent, $launcher) !== false) 
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Analyzes the launcher version to determine if cheats were prevented.
     * Note: This logic relies on legacy version strings.
     */
    public static function getLauncherStatus(string $userAgent, bool $debug = false): string
    {
        $parts = explode(" ", $userAgent);
        $version = $parts[1] ?? '0.0.0.0'; // Default if version missing

        // Logic for GameLauncher
        if (strpos($userAgent, 'GameLauncher') !== false) 
        {
            /* Version 1 */
            if (version_compare($version, '2.1.6.6', "<=")) 
            {
                return "*Launcher Did Not Prevent Cheats for this User*";
            }
            else if (version_compare($version, '2.1.7.8', "<=") || version_compare($version, '3.1.7.7', "==")) 
            {
                return "*Launcher Prevented Cheats for this User*";
            }
            /* Version 2 */
            else if(version_compare($version, '2.1.8.8', "<="))
            {
                return "*After 1 Minute of a Detection\nLauncher Prevented Cheats for this User*";
            }
            /* Version 3 */
            else if(version_compare($version, '2.1.9.0002', "<="))
            {
                return "*After 1 Minute of a Detection\nLauncher Prevented Cheats for this User*";
            }
            /* Version 4 */
            else
            {
                return "*After 1 Minute of a Detection\nLauncher Prevented Cheats for this User*";
            }
        }
        // Logic for SBRW Launcher
        else if (strpos($userAgent, 'SBRW Launcher') !== false) 
        {
            //Offset index by 1 due to space in name "SBRW Launcher"
            $version = $parts[2] ?? '0.0.0.0';
            /* Version 1 */
            if(version_compare($version, '2.1.6.6', "<="))
            {
                return "*Launcher Did Not Prevent Cheats for this User*";
            }
            else if(version_compare($version, '2.1.7.8', "<=") || version_compare($version, '3.1.7.7', "=="))
            {
                return "*Launcher Prevented Cheats for this User*";
            }
            /* Version 2 */
            else if(version_compare($version, '2.1.8.8', "<="))
            {
                return "*After 1 Minute of a Detection\nLauncher Prevented Cheats for this User*";
            }
            /* Version 3 */
            else if(version_compare($version, '2.1.9.0002', "<="))
            {
                return "*After 1 Minute of a Detection\nLauncher Prevented Cheats for this User*";
            }
            /* Version 4 */
            else
            {
                return "*After 2 Minutes of a Detection\nLauncher Prevented Cheats for this User*";
            }            
        }
        else if(strpos($string, 'LegacyLauncher') !== false)
        {
            if(count($version) > 0)
            {
                /* Version -1 */
                if(version_compare($version, '1.0.5.0', "<="))
                {
                    return "*Launcher Did Not Prevent Cheats for this User*";
                }
                /* Version 1 */
                else
                {
                    return "*Launcher Prevented Cheats for this User*";
                }
            }
            /* Version -1 */
            else
            {
                return "*Launcher **May Have** Prevented Cheats for this User*";
            }
        }        
        else if($debug == true)
        {
            /* Just a Debug Report, Its Safe to Disregard this */
            return "Woah! You are not Shotaro Tokuno!\nAnyhow, this is a Mock Debug Report";
        }
        else
        {
            /* Generic Response */
            return 'Unknown Details about the Launcher';
        }
    }

    /**
     * Sanitizes and Formats specific report fields based on their type.
     */
    public static function formatField(string $fieldType, $value, bool $debug = false): ?string
    {
        //Handle Empty/Null Values
        if (empty($value)) 
        {
            switch ($fieldType) 
            {
                case 'Operating-System':
                    return "**OPERATING SYSTEM**\nNo Information Provided";
                case 'Operating-Version':
                    return NULL; // Skip this field entirely
                case 'Event-Status':
                    return 'COMPLETED';
                case 'Internal-Error':
                    return "No Base Exception Provided";
                default:
                    return "No {$fieldType} Provided";
            }
        }

        switch ($fieldType) 
        {
            case 'Alert-Status':
                return self::getLauncherStatus($value, $debug);
            case 'Internal-Error':
                return "Base Exception: " . $value;
            case 'Car-ID':
            case 'Persona-ID':
            case 'User-ID':
                return $value;
            case 'Operating-System':
                return "**OPERATING SYSTEM**\n" . $value;
            case 'Operating-Version':
                return " (".$value.")";
            case 'Event-Status':
                if(strtolower($value) == "true")
                {
                    return 'COMPLETED';
                }
                else
                {
                    return 'QUIT';
                }
            case 'User-Agent':
                if (self::getLauncherStatus($value, $debug))
                {
                    if($debug)
                    {
                        return "**LAUNCHER VERSION**\nDebug Report Only";
                    }
                    else
                    {
                        return "**LAUNCHER VERSION**\n".$value;
                    }
                }
                else
                {
                    return "**INVALID REPORT**\nWeb Browser";
                }
            default:
                // Default sensitive fields (like HWID) get spoiler tags
                return "||" . $value . "||";
        }
    }

    /**
     * Removes forbidden characters from usernames.
     */
    public static function sanitizeUserName(string $username): string
    {
        if (empty($username)) 
        {
            return 'Username is Null';
        }

        // Convert forbidden chars to correct encoding if necessary, or just strip them
        $cleanName = $username;
        foreach (self::FORBIDDEN_CHARS as $char) 
        {
            // Use utf8_encode if input encoding was inconsistent
            $target = utf8_encode($char); 
            $cleanName = str_replace($target, '', $cleanName);
        }

        return $cleanName;
    }
}

function LauncherAllowList($string, $debug = false) 
{
    return StringChecker::isLauncherAllowed($string, $debug);
}
/* Launcher's Version Comparison (String Check: Alert-Status) */
function AlertStatusReportVersion($string, $debug = false)
{
    return StringChecker::getLauncherStatus($string, $debug);
}

function CheckProvidedValue($type, $value, $debug = false)
{
    return StringChecker::formatField($type, $value, $debug);
}

function CheckUserName($string) 
{        
    return StringChecker::sanitizeUserName($string);
}
?>