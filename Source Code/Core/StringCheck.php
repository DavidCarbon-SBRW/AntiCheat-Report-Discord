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
        else if(strpos($userAgent, 'LegacyLauncher') !== false)
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
    
    // Source - https://stackoverflow.com/a/46091843
    // Posted by Timo Huovinen, modified by community. See post 'Timeline' for change history
    // Retrieved 2025-11-27, License - CC BY-SA 4.0

    /**
     * @param $user_agent null
     * @return string
     */
    public static function getOS($user_agent = null): string
    {
        if(!isset($user_agent)) 
        {
            if (isset($_SERVER['HTTP_OS_VERSION']))
            {
                return $_SERVER['HTTP_OS_VERSION'];
            }
            else if (isset($_SERVER['HTTP_USER_AGENT']))
            {
                $user_agent = $_SERVER['HTTP_USER_AGENT'];
            }
        }

        // https://stackoverflow.com/questions/18070154/get-operating-system-info-with-php
        $os_array = [
            'windows nt 10'                              =>  'Windows 10',
            'windows nt 6.3'                             =>  'Windows 8.1',
            'windows nt 6.2'                             =>  'Windows 8',
            'windows nt 6.1|windows nt 7.0'              =>  'Windows 7',
            'windows nt 6.0'                             =>  'Windows Vista',
            'windows nt 5.2'                             =>  'Windows Server 2003/XP x64',
            'windows nt 5.1'                             =>  'Windows XP',
            'windows xp'                                 =>  'Windows XP',
            'windows nt 5.0|windows nt5.1|windows 2000'  =>  'Windows 2000',
            'windows me'                                 =>  'Windows ME',
            'windows nt 4.0|winnt4.0'                    =>  'Windows NT',
            'windows ce'                                 =>  'Windows CE',
            'windows 98|win98'                           =>  'Windows 98',
            'windows 95|win95'                           =>  'Windows 95',
            'win16'                                      =>  'Windows 3.11',
            'mac os x 10.1[^0-9]'                        =>  'Mac OS X Puma',
            'macintosh|mac os x'                         =>  'Mac OS X',
            'mac_powerpc'                                =>  'Mac OS 9',
            'ubuntu'                                     =>  'Linux - Ubuntu',
            'iphone'                                     =>  'iPhone',
            'ipod'                                       =>  'iPod',
            'ipad'                                       =>  'iPad',
            'android'                                    =>  'Android',
            'cros'                                       =>  'Chrome OS',
            'blackberry'                                 =>  'BlackBerry',
            'webos'                                      =>  'Mobile',
            'linux'                                      =>  'Linux',

            '(media center pc).([0-9]{1,2}\.[0-9]{1,2})'=>'Windows Media Center',
            '(win)([0-9]{1,2}\.[0-9x]{1,2})'=>'Windows',
            '(win)([0-9]{2})'=>'Windows',
            '(windows)([0-9x]{2})'=>'Windows',

            // Doesn't seem like these are necessary...not totally sure though..
            //'(winnt)([0-9]{1,2}\.[0-9]{1,2}){0,1}'=>'Windows NT',
            //'(windows nt)(([0-9]{1,2}\.[0-9]{1,2}){0,1})'=>'Windows NT', // fix by bg

            'Win 9x 4.90'=>'Windows ME',
            '(windows)([0-9]{1,2}\.[0-9]{1,2})'=>'Windows',
            'win32'=>'Windows',
            '(java)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,2})'=>'Java',
            '(Solaris)([0-9]{1,2}\.[0-9x]{1,2}){0,1}'=>'Solaris',
            'dos x86'=>'DOS',
            'Mac OS X'=>'Mac OS X',
            'Mac_PowerPC'=>'Macintosh PowerPC',
            '(mac|Macintosh)'=>'Mac OS',
            '(sunos)([0-9]{1,2}\.[0-9]{1,2}){0,1}'=>'SunOS',
            '(beos)([0-9]{1,2}\.[0-9]{1,2}){0,1}'=>'BeOS',
            '(risc os)([0-9]{1,2}\.[0-9]{1,2})'=>'RISC OS',
            'unix'=>'Unix',
            'os/2'=>'OS/2',
            'freebsd'=>'FreeBSD',
            'openbsd'=>'OpenBSD',
            'netbsd'=>'NetBSD',
            'irix'=>'IRIX',
            'plan9'=>'Plan9',
            'osf'=>'OSF',
            'aix'=>'AIX',
            'GNU Hurd'=>'GNU Hurd',
            '(fedora)'=>'Linux - Fedora',
            '(kubuntu)'=>'Linux - Kubuntu',
            '(ubuntu)'=>'Linux - Ubuntu',
            '(debian)'=>'Linux - Debian',
            '(CentOS)'=>'Linux - CentOS',
            '(Mandriva).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)'=>'Linux - Mandriva',
            '(SUSE).([0-9]{1,3}(\.[0-9]{1,3})?(\.[0-9]{1,3})?)'=>'Linux - SUSE',
            '(Dropline)'=>'Linux - Slackware (Dropline GNOME)',
            '(ASPLinux)'=>'Linux - ASPLinux',
            '(Red Hat)'=>'Linux - Red Hat',
            // Loads of Linux machines will be detected as unix.
            // Actually, all of the linux machines I've checked have the 'X11' in the User Agent.
            //'X11'=>'Unix',
            '(linux)'=>'Linux',
            '(amigaos)([0-9]{1,2}\.[0-9]{1,2})'=>'AmigaOS',
            'amiga-aweb'=>'AmigaOS',
            'amiga'=>'Amiga',
            'AvantGo'=>'PalmOS',
            //'(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1}-([0-9]{1,2}) i([0-9]{1})86){1}'=>'Linux',
            //'(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1} i([0-9]{1}86)){1}'=>'Linux',
            //'(Linux)([0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}(rel\.[0-9]{1,2}){0,1})'=>'Linux',
            '[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{1,3}'=>'Linux',
            '(webtv)/([0-9]{1,2}\.[0-9]{1,2})'=>'WebTV',
            'Dreamcast'=>'Dreamcast OS',
            'GetRight'=>'Windows',
            'go!zilla'=>'Windows',
            'gozilla'=>'Windows',
            'gulliver'=>'Windows',
            'ia archiver'=>'Windows',
            'NetPositive'=>'Windows',
            'mass downloader'=>'Windows',
            'microsoft'=>'Windows',
            'offline explorer'=>'Windows',
            'teleport'=>'Windows',
            'web downloader'=>'Windows',
            'webcapture'=>'Windows',
            'webcollage'=>'Windows',
            'webcopier'=>'Windows',
            'webstripper'=>'Windows',
            'webzip'=>'Windows',
            'wget'=>'Windows',
            'Java'=>'Unknown',
            'flashget'=>'Windows',

            // delete next line if the script show not the right OS
            //'(PHP)/([0-9]{1,2}.[0-9]{1,2})'=>'PHP',
            'MS FrontPage'=>'Windows',
            '(msproxy)/([0-9]{1,2}.[0-9]{1,2})'=>'Windows',
            '(msie)([0-9]{1,2}.[0-9]{1,2})'=>'Windows',
            'libwww-perl'=>'Unix',
            'UP.Browser'=>'Windows CE',
            'NetAnts'=>'Windows',
        ];

        // https://github.com/ahmad-sa3d/php-useragent/blob/master/core/user_agent.php
        $arch_regex = '/\b(x86_64|x86-64|Win64|WOW64|x64|ia64|amd64|ppc64|sparc64|IRIX64)\b/ix';
        $arch = preg_match($arch_regex, $user_agent) ? '64' : '32';

        foreach ($os_array as $regex => $value)
        {
            if (preg_match('{\b('.$regex.')\b}i', $user_agent)) 
            {
                return $value.' x'.$arch;
            }
        }

        return 'Unknown';
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