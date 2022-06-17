<?php
/* FailSafe Version Format (Pre-Format Reports) */
function FailSafeReportVersionFormat($string, $debug = false, $debug_version = 0)
{
    try
    {
        if(strpos($string, 'GameLauncher') !== false || strpos($string, 'SBRW Launcher') !== false)
        {
                $version_split = explode(" ", $string);
                /* Version 1 */
                if(version_compare($version_split[1], '2.1.7.8', "<="))
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

/* Alerts */

function Json_Format_Version_Alert_One($server_IP, $future_Version, $changelog_Message, $ac_Footer, $ac_Version, $debug = false)
{
    return [
    /*
     * The general "message" shown above your embeds
     */
    "content" => "",
    /*
     * The username shown in the message
     */
    "username" => ProfileName($server_IP),
    /*
     * The image location for the senders image
     */
    "avatar_url" => ProfileIconURL($server_IP).'?'.$ac_Version,
    /*
     * Whether or not to read the message in Text-to-speech
     */
    "tts" => false,
    /*
     * File contents to send to upload a file
     */
    // "file" => "",
    /*
     * An array of Embeds
     */
    "embeds" => [
        /*
         * Our first embed
         */
        [

            //Title: Player's Name
            "title" => "Upcoming Changes with version ".$future_Version,

            //The type of your embed, will ALWAYS be "rich"
            "type" => "rich",

            //The User-Agent of the GameLauncher and Operating System's Name
            "description" => $changelog_Message,
            /*
            //The URL of the Player on a Player Panel if available
            "url" => PlayerPanel($server_IP, $persona_ID, CheckUserName($persona_Name)),
            */
            /* A timestamp to be displayed below the embed, IE for when an an article was posted
             * This must be formatted as ISO8601
             */
            "timestamp" => gmdate("Y-m-d\TH:i:s\Z"),

            //The integer color to be used on the left side of the embed
            "color" => hexdec( "9FC120" ),

            //Footer Object: Reporter Footer
            "footer" => [
                "text" => "Eagle Jump • ".$ac_Footer." v".$ac_Version." • UIDR Format v4.0",
                "icon_url" => "https://i.eaglejump.org/logos/textless/Eagle%20Jump%20Logo.webp"
            ],
            
            //Thumbnail Object: Gets Event Image
            "thumbnail" => [
                "url" => 'https://i3-sbrw.davidcarbon.download/assets/recreated/Soapbox%20Race%20World%20Logo%20Text%20(Shadow%20Effect)%20-%20Web.webp'
            ],

            //Author Object: Server name with Web Site Link
            "author" => [
                "name" => 'Umiko Ahagon',
                "icon_url" => 'https://i.eaglejump.org/team/Umiko%20Ahagon.webp'
            ]
        ]
    ]
];
}

/* User ID Only Report */

function Json_Format_Version_Negative_Four($server_IP, $user_ID, $cheat_Type, $hwid_LevelOne, $discord_ID, $launcher_Hash, $launcher_Handshake, $launcher_UserAgent, $platform_OS, $version_OS, $ac_Footer, $ac_Version, $debug = false)
{
    return [
    /*
     * The general "message" shown above your embeds
     */
    "content" => "",
    /*
     * The username shown in the message
     */
    "username" => ProfileName($server_IP),
    /*
     * The image location for the senders image
     */
    "avatar_url" => ProfileIconURL($server_IP).'?'.$ac_Version,
    /*
     * Whether or not to read the message in Text-to-speech
     */
    "tts" => false,
    /*
     * File contents to send to upload a file
     */
    // "file" => "",
    /*
     * An array of Embeds
     */
    "embeds" => [
        /*
         * Our first embed
         */
        [
            /*
            //Title: Player's Name
            "title" => "Profile for ".CheckUserName($persona_Name),
            */
            //The type of your embed, will ALWAYS be "rich"
            "type" => "rich",

            //The User-Agent of the GameLauncher and Operating System's Name
            "description" => CheckProvidedValue("User-Agent", $launcher_UserAgent, $debug)."\n".CheckProvidedValue("Operating-System", $platform_OS, $debug).CheckProvidedValue("Operating-Version", $version_OS, $debug),
            /*
            //The URL of the Player on a Player Panel if available
            "url" => PlayerPanel($server_IP, $persona_ID, CheckUserName($persona_Name)),
            */
            /* A timestamp to be displayed below the embed, IE for when an an article was posted
             * This must be formatted as ISO8601
             */
            "timestamp" => gmdate("Y-m-d\TH:i:s\Z"),

            //The integer color to be used on the left side of the embed
            "color" => hexdec( "FAB440" ),

            //Footer Object: Reporter Footer
            "footer" => [
                "text" => "Eagle Jump • ".$ac_Footer." v".$ac_Version." • UIDR Format v4.0",
                "icon_url" => "https://i.eaglejump.org/logos/textless/Eagle%20Jump%20Logo.webp"
            ],
            /*
            //Image Object: Not Used
            "image" => [
                "url" => "https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png"
            ],
            */
            //Thumbnail Object: Gets Event Image
            "thumbnail" => [
                "url" => "https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/IMG/gamemode_unknown.png"
            ],

            //Author Object: Server name with Web Site Link
            "author" => [
                "name" => ServerName($server_IP),
                "url" => ServerSiteLink($server_IP)
            ],
            // Field array of objects
            "fields" => [
                //Field: How was the Process Treated?
                [
                    "name" => "ALERT",
                    "value" => CheckProvidedValue("Alert-Status", $launcher_UserAgent, $debug),
                    "inline" => false
                ],
                //Field: Cheats
                [
                    "name" => "CHEAT",
                    "value" => CheatType($cheat_Type),
                    "inline" => false
                ],
                //Field: Player's Account ID
                [
                    "name" => "USER ID",
                    "value" => CheckProvidedValue("User-ID", $user_ID, $debug),
                    "inline" => true
                ],
                //Field: HWID
                [
                    "name" => "HARDWARE ID",
                    "value" => CheckProvidedValue("HWID", $hwid_LevelOne, $debug),
                    "inline" => false
                ],
                //Field: HWID
                [
                    "name" => "DISCORD ID",
                    "value" => CheckProvidedValue("Discord-ID", $discord_ID, $debug),
                    "inline" => false
                ],
                //Field: Hash
                [
                    "name" => "LAUNCHER HASH",
                    "value" => CheckProvidedValue("Hash", $launcher_Hash, $debug),
                    "inline" => false
                ],
                //Field: Hash
                [
                    "name" => "LAUNCHER HANDSHAKE",
                    "value" => CheckProvidedValue("Key", $launcher_Handshake, $debug),
                    "inline" => false
                ]
            ]
        ]
    ]
];
}

function Json_Format_Version_Negative_Three($server_IP, $user_ID, $cheat_Type, $hwid_LevelOne, $launcher_Hash, $launcher_Handshake, $launcher_UserAgent, $platform_OS, $version_OS, $ac_Footer, $ac_Version, $debug = false)
{
    return [
    /*
     * The general "message" shown above your embeds
     */
    "content" => "",
    /*
     * The username shown in the message
     */
    "username" => ProfileName($server_IP),
    /*
     * The image location for the senders image
     */
    "avatar_url" => ProfileIconURL($server_IP).'?'.$ac_Version,
    /*
     * Whether or not to read the message in Text-to-speech
     */
    "tts" => false,
    /*
     * File contents to send to upload a file
     */
    // "file" => "",
    /*
     * An array of Embeds
     */
    "embeds" => [
        /*
         * Our first embed
         */
        [
            /*
            //Title: Player's Name
            "title" => "Profile for ".CheckUserName($persona_Name),
            */
            //The type of your embed, will ALWAYS be "rich"
            "type" => "rich",

            //The User-Agent of the GameLauncher and Operating System's Name
            "description" => CheckProvidedValue("User-Agent", $launcher_UserAgent, $debug)."\n".CheckProvidedValue("Operating-System", $platform_OS, $debug).CheckProvidedValue("Operating-Version", $version_OS, $debug),
            /*
            //The URL of the Player on a Player Panel if available
            "url" => PlayerPanel($server_IP, $persona_ID, CheckUserName($persona_Name)),
            */
            /* A timestamp to be displayed below the embed, IE for when an an article was posted
             * This must be formatted as ISO8601
             */
            "timestamp" => gmdate("Y-m-d\TH:i:s\Z"),

            //The integer color to be used on the left side of the embed
            "color" => hexdec( "FAB440" ),

            //Footer Object: Reporter Footer
            "footer" => [
                "text" => "Eagle Jump • ".$ac_Footer." v".$ac_Version." • UIDR Format v3.0",
                "icon_url" => "https://i.eaglejump.org/logos/textless/Eagle%20Jump%20Logo.webp"
            ],
            /*
            //Image Object: Not Used
            "image" => [
                "url" => "https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png"
            ],
            */
            //Thumbnail Object: Gets Event Image
            "thumbnail" => [
                "url" => "https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/IMG/gamemode_unknown.png"
            ],

            //Author Object: Server name with Web Site Link
            "author" => [
                "name" => ServerName($server_IP),
                "url" => ServerSiteLink($server_IP)
            ],
            // Field array of objects
            "fields" => [
                //Field: How was the Process Treated?
                [
                    "name" => "ALERT",
                    "value" => CheckProvidedValue("Alert-Status", $launcher_UserAgent, $debug),
                    "inline" => false
                ],
                //Field: Cheats
                [
                    "name" => "CHEAT",
                    "value" => CheatType($cheat_Type),
                    "inline" => false
                ],
                //Field: Player's Account ID
                [
                    "name" => "USER ID",
                    "value" => CheckProvidedValue("User-ID", $user_ID, $debug),
                    "inline" => true
                ],
                //Field: HWID
                [
                    "name" => "LEVEL 1 HWID",
                    "value" => CheckProvidedValue("HWID", $hwid_LevelOne, $debug),
                    "inline" => false
                ],
                //Field: Hash
                [
                    "name" => "LAUNCHER HASH",
                    "value" => CheckProvidedValue("Hash", $launcher_Hash, $debug),
                    "inline" => false
                ],
                //Field: Hash
                [
                    "name" => "LAUNCHER HANDSHAKE",
                    "value" => CheckProvidedValue("Key", $launcher_Handshake, $debug),
                    "inline" => false
                ]
            ]
        ]
    ]
];
}

function Json_Format_Version_Negative_Two($server_IP, $user_ID, $cheat_Type, $hwid_LevelOne, $hwid_LevelTwo, $launcher_Hash, $launcher_Handshake, $launcher_UserAgent, $platform_OS, $version_OS, $ac_Footer, $ac_Version, $debug = false)
{
    return [
    /*
     * The general "message" shown above your embeds
     */
    "content" => "",
    /*
     * The username shown in the message
     */
    "username" => ProfileName($server_IP),
    /*
     * The image location for the senders image
     */
    "avatar_url" => ProfileIconURL($server_IP).'?'.$ac_Version,
    /*
     * Whether or not to read the message in Text-to-speech
     */
    "tts" => false,
    /*
     * File contents to send to upload a file
     */
    // "file" => "",
    /*
     * An array of Embeds
     */
    "embeds" => [
        /*
         * Our first embed
         */
        [
            /*
            //Title: Player's Name
            "title" => "Profile for ".CheckUserName($persona_Name),
            */
            //The type of your embed, will ALWAYS be "rich"
            "type" => "rich",

            //The User-Agent of the GameLauncher and Operating System's Name
            "description" => CheckProvidedValue("User-Agent", $launcher_UserAgent, $debug)."\n".CheckProvidedValue("Operating-System", $platform_OS, $debug).CheckProvidedValue("Operating-Version", $version_OS, $debug),
            /*
            //The URL of the Player on a Player Panel if available
            "url" => PlayerPanel($server_IP, $persona_ID, CheckUserName($persona_Name)),
            */
            /* A timestamp to be displayed below the embed, IE for when an an article was posted
             * This must be formatted as ISO8601
             */
            "timestamp" => gmdate("Y-m-d\TH:i:s\Z"),

            //The integer color to be used on the left side of the embed
            "color" => hexdec( "FAB440" ),

            //Footer Object: Reporter Footer
            "footer" => [
                "text" => "Eagle Jump • ".$ac_Footer." v".$ac_Version." • UIDR Format v2.0",
                "icon_url" => "https://i.eaglejump.org/logos/textless/Eagle%20Jump%20Logo.webp"
            ],
            /*
            //Image Object: Not Used
            "image" => [
                "url" => "https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png"
            ],
            */
            //Thumbnail Object: Gets Event Image
            "thumbnail" => [
                "url" => "https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/IMG/gamemode_unknown.png"
            ],

            //Author Object: Server name with Web Site Link
            "author" => [
                "name" => ServerName($server_IP),
                "url" => ServerSiteLink($server_IP)
            ],
            // Field array of objects
            "fields" => [
                //Field: How was the Process Treated?
                [
                    "name" => "ALERT",
                    "value" => CheckProvidedValue("Alert-Status", $launcher_UserAgent, $debug),
                    "inline" => false
                ],
                //Field: Cheats
                [
                    "name" => "CHEAT",
                    "value" => CheatType($cheat_Type),
                    "inline" => false
                ],
                //Field: Player's Account ID
                [
                    "name" => "USER ID",
                    "value" => CheckProvidedValue("User-ID", $user_ID, $debug),
                    "inline" => true
                ],
                //Field: HWID
                [
                    "name" => "LEVEL 1 HWID",
                    "value" => CheckProvidedValue("HWID", $hwid_LevelOne, $debug),
                    "inline" => false
                ],
                //Field: HWID
                [
                    "name" => "LEVEL 2 HWID",
                    "value" => CheckProvidedValue("HWID", $hwid_LevelTwo, $debug),
                    "inline" => false
                ],
                //Field: Hash
                [
                    "name" => "LAUNCHER HASH",
                    "value" => CheckProvidedValue("Hash", $launcher_Hash, $debug),
                    "inline" => false
                ],
                //Field: Hash
                [
                    "name" => "LAUNCHER HANDSHAKE",
                    "value" => CheckProvidedValue("Key", $launcher_Handshake, $debug),
                    "inline" => false
                ]
            ]
        ]
    ]
];
}

function Json_Format_Version_Negative_One($server_IP, $user_ID, $cheat_Type, $hwid_LevelOne, $launcher_UserAgent, $ac_Footer, $ac_Version, $debug = false)
{
    return [
    /*
     * The general "message" shown above your embeds
     */
    "content" => "",
    /*
     * The username shown in the message
     */
    "username" => ProfileName($server_IP),
    /*
     * The image location for the senders image
     */
    "avatar_url" => ProfileIconURL($server_IP).'?'.$ac_Version,
    /*
     * Whether or not to read the message in Text-to-speech
     */
    "tts" => false,
    /*
     * File contents to send to upload a file
     */
    // "file" => "",
    /*
     * An array of Embeds
     */
    "embeds" => [
        /*
         * Our first embed
         */
        [
            /*
            //Title: Player's Name
            "title" => "Profile for ".CheckUserName($persona_Name),
            */
            //The type of your embed, will ALWAYS be "rich"
            "type" => "rich",

            //The User-Agent of the GameLauncher and Operating System's Name
            "description" => CheckProvidedValue("User-Agent", $launcher_UserAgent, $debug),
            /*
            //The URL of the Player on a Player Panel if available
            "url" => PlayerPanel($server_IP, $persona_ID, CheckUserName($persona_Name)),
            */
            /* A timestamp to be displayed below the embed, IE for when an an article was posted
             * This must be formatted as ISO8601
             */
            "timestamp" => gmdate("Y-m-d\TH:i:s\Z"),

            //The integer color to be used on the left side of the embed
            "color" => hexdec( "FAB440" ),

            //Footer Object: Reporter Footer
            "footer" => [
                "text" => "Eagle Jump • ".$ac_Footer." v".$ac_Version." • UIDR Format v1.0",
                "icon_url" => "https://i.eaglejump.org/logos/textless/Eagle%20Jump%20Logo.webp"
            ],
            /*
            //Image Object: Not Used
            "image" => [
                "url" => "https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png"
            ],
            */
            //Thumbnail Object: Gets Event Image
            "thumbnail" => [
                "url" => "https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/IMG/gamemode_unknown.png"
            ],

            //Author Object: Server name with Web Site Link
            "author" => [
                "name" => ServerName($server_IP),
                "url" => ServerSiteLink($server_IP)
            ],
            // Field array of objects
            "fields" => [
                //Field: How was the Process Treated?
                [
                    "name" => "ALERT",
                    "value" => CheckProvidedValue("Alert-Status", $launcher_UserAgent, $debug),
                    "inline" => false
                ],
                //Field: Cheats
                [
                    "name" => "CHEAT",
                    "value" => CheatType($cheat_Type),
                    "inline" => false
                ],
                //Field: Player's Account ID
                [
                    "name" => "USER ID",
                    "value" => CheckProvidedValue("User-ID", $user_ID, $debug),
                    "inline" => true
                ],
                //Field: HWID
                [
                    "name" => "HARDWARE ID",
                    "value" => CheckProvidedValue("HWID", $hwid_LevelOne, $debug),
                    "inline" => false
                ]
            ]
        ]
    ]
];
}

/* Full Detailed Report */

function Json_Format_Version_One($server_IP, $user_ID, $persona_Name, $persona_ID, $event_Session, $cheat_Type, $hwid_LevelOne, $launcher_UserAgent, $ac_Footer, $ac_Version, $debug = false)
{
    return [
    /*
     * The general "message" shown above your embeds
     */
    "content" => "",
    /*
     * The username shown in the message
     */
    "username" => ProfileName($server_IP),
    /*
     * The image location for the senders image
     */
    "avatar_url" => ProfileIconURL($server_IP).'?'.$ac_Version,
    /*
     * Whether or not to read the message in Text-to-speech
     */
    "tts" => false,
    /*
     * File contents to send to upload a file
     */
    // "file" => "",
    /*
     * An array of Embeds
     */
    "embeds" => [
        /*
         * Our first embed
         */
        [
            //Title: Player's Name
            "title" => "Profile for ".CheckUserName($persona_Name),

            //The type of your embed, will ALWAYS be "rich"
            "type" => "rich",

            //The User-Agent of the GameLauncher and Operating System's Name
            "description" => CheckProvidedValue("User-Agent", $launcher_UserAgent, $debug),

            //The URL of the Player on a Player Panel if available
            "url" => PlayerPanel($server_IP, $persona_ID, CheckUserName($persona_Name)),

            /* A timestamp to be displayed below the embed, IE for when an an article was posted
             * This must be formatted as ISO8601
             */
            "timestamp" => gmdate("Y-m-d\TH:i:s\Z"),

            //The integer color to be used on the left side of the embed
            "color" => hexdec( "FF0000" ),

            //Footer Object: Reporter Footer
            "footer" => [
                "text" => "Eagle Jump • ".$ac_Footer." v".$ac_Version." • FDR Format v1.0",
                "icon_url" => "https://i.eaglejump.org/logos/textless/Eagle%20Jump%20Logo.webp"
            ],
            /*
            //Image Object: Not Used
            "image" => [
                "url" => "https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png"
            ],
            */
            //Thumbnail Object: Gets Event Image
            "thumbnail" => [
                "url" => GetEventImageFromFile($event_Session, EventListLink($server_IP))
            ],

            //Author Object: Server name with Web Site Link
            "author" => [
                "name" => ServerName($server_IP),
                "url" => ServerSiteLink($server_IP)
            ],
            // Field array of objects
            "fields" => [
                //Field: Cheats
                [
                    "name" => "CHEAT",
                    "value" => CheatType($cheat_Type),
                    "inline" => false
                ],
                //Field: Player's Username
                [
                    "name" => "PERSONA",
                    "value" => CheckUserName($persona_Name),
                    "inline" => true
                ],
                //Field: Player's Selected Driver ID
                [
                    "name" => "PERSONA ID",
                    "value" => CheckProvidedValue("Persona-ID", $persona_ID, $debug),
                    "inline" => true
                ],
                //Field: Player's Account ID
                [
                    "name" => "USER ID",
                    "value" => CheckProvidedValue("User-ID", $user_ID, $debug),
                    "inline" => true
                ],
                //Field: Event Name
                [
                    "name" => "EVENT ID",
                    "value" => GetEventNameFromFile($event_Session, EventListLink($server_IP)),
                    "inline" => true
                ],
                //Field: HWID
                [
                    "name" => "HARDWARE ID",
                    "value" => CheckProvidedValue("HWID", $hwid_LevelOne, $debug),
                    "inline" => false
                ]
            ]
        ]
    ]
];
}

function Json_Format_Version_Two($server_IP, $user_ID, $persona_Name, $persona_ID, $event_Session, $event_CompletionStatus, $cheat_Type, $car_Name, $hwid_LevelOne, $hwid_LevelTwo, $launcher_Hash, $launcher_Handshake, $launcher_UserAgent, $platform_OS, $version_OS, $ac_Footer, $ac_Version, $debug = false)
{
    return [
    /*
     * The general "message" shown above your embeds
     */
    "content" => "",
    /*
     * The username shown in the message
     */
    "username" => ProfileName($server_IP),
    /*
     * The image location for the senders image
     */
    "avatar_url" => ProfileIconURL($server_IP).'?'.$ac_Version,
    /*
     * Whether or not to read the message in Text-to-speech
     */
    "tts" => false,
    /*
     * File contents to send to upload a file
     */
    // "file" => "",
    /*
     * An array of Embeds
     */
    "embeds" => [
        /*
         * Our first embed
         */
        [
            //Title: Player's Name
            "title" => "Profile for ".CheckUserName($persona_Name),

            //The type of your embed, will ALWAYS be "rich"
            "type" => "rich",

            //The User-Agent of the GameLauncher and Operating System's Name
            "description" => CheckProvidedValue("User-Agent", $launcher_UserAgent, $debug)."\n".CheckProvidedValue("Operating-System", $platform_OS, $debug).CheckProvidedValue("Operating-Version", $version_OS, $debug),

            //The URL of the Player on a Player Panel if available
            "url" => PlayerPanel($server_IP, $persona_ID, CheckUserName($persona_Name)),

            /* A timestamp to be displayed below the embed, IE for when an an article was posted
             * This must be formatted as ISO8601
             */
            "timestamp" => gmdate("Y-m-d\TH:i:s\Z"),

            //The integer color to be used on the left side of the embed
            "color" => hexdec( "FF0000" ),

            //Footer Object: Reporter Footer
            "footer" => [
                "text" => "Eagle Jump • ".$ac_Footer." v".$ac_Version." • FDR Format v2.0",
                "icon_url" => "https://i.eaglejump.org/logos/textless/Eagle%20Jump%20Logo.webp"
            ],
            /*
            //Image Object: Not Used
            "image" => [
                "url" => "https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png"
            ],
            */
            //Thumbnail Object: Gets Event Image
            "thumbnail" => [
                "url" => GetEventImageFromFile($event_Session, EventListLink($server_IP))
            ],

            //Author Object: Server name with Web Site Link
            "author" => [
                "name" => ServerName($server_IP),
                "url" => ServerSiteLink($server_IP)
            ],
            // Field array of objects
            "fields" => [
                //Field: Cheats
                [
                    "name" => "CHEAT",
                    "value" => CheatType($cheat_Type),
                    "inline" => false
                ],
                //Field: Player's Username
                [
                    "name" => "PERSONA",
                    "value" => CheckUserName($persona_Name),
                    "inline" => true
                ],
                //Field: Player's Selected Driver ID
                [
                    "name" => "PERSONA ID",
                    "value" => CheckProvidedValue("Persona-ID", $persona_ID, $debug),
                    "inline" => true
                ],
                //Field: Player's Account ID
                [
                    "name" => "USER ID",
                    "value" => CheckProvidedValue("User-ID", $user_ID, $debug),
                    "inline" => true
                ],
                //Field: Event Name
                [
                    "name" => "EVENT ID ***-> [".CheckProvidedValue("Event-Status", $event_CompletionStatus, $debug)."]***",
                    "value" => GetEventNameFromFile($event_Session, EventListLink($server_IP)),
                    "inline" => true
                ],
                //Field: Car Name
                [
                    "name" => "CAR ID",
                    "value" => CheckProvidedValue("Car-ID", $car_Name, $debug),
                    "inline" => false
                ],
                //Field: HWID
                [
                    "name" => "LEVEL 1 HWID",
                    "value" => CheckProvidedValue("HWID", $hwid_LevelOne, $debug),
                    "inline" => false
                ],
                //Field: HWID
                [
                    "name" => "LEVEL 2 HWID",
                    "value" => CheckProvidedValue("HWID", $hwid_LevelTwo, $debug),
                    "inline" => false
                ],
                //Field: Hash
                [
                    "name" => "LAUNCHER HASH",
                    "value" => CheckProvidedValue("Hash", $launcher_Hash, $debug),
                    "inline" => false
                ],
                //Field: Hash
                [
                    "name" => "LAUNCHER HANDSHAKE",
                    "value" => CheckProvidedValue("Key", $launcher_Handshake, $debug),
                    "inline" => false
                ]
            ]
        ]
    ]
];
}

function Json_Format_Version_Three($server_IP, $user_ID, $persona_Name, $persona_ID, $event_Session, $event_CompletionStatus, $cheat_Type, $car_Name, $hwid_LevelOne, $launcher_Hash, $launcher_Handshake, $launcher_UserAgent, $platform_OS, $version_OS, $ac_Footer, $ac_Version, $debug = false)
{
    return [
    /*
     * The general "message" shown above your embeds
     */
    "content" => "",
    /*
     * The username shown in the message
     */
    "username" => ProfileName($server_IP),
    /*
     * The image location for the senders image
     */
    "avatar_url" => ProfileIconURL($server_IP).'?'.$ac_Version,
    /*
     * Whether or not to read the message in Text-to-speech
     */
    "tts" => false,
    /*
     * File contents to send to upload a file
     */
    // "file" => "",
    /*
     * An array of Embeds
     */
    "embeds" => [
        /*
         * Our first embed
         */
        [
            //Title: Player's Name
            "title" => "Profile for ".CheckUserName($persona_Name),

            //The type of your embed, will ALWAYS be "rich"
            "type" => "rich",

            //The User-Agent of the GameLauncher and Operating System's Name
            "description" => CheckProvidedValue("User-Agent", $launcher_UserAgent, $debug)."\n".CheckProvidedValue("Operating-System", $platform_OS, $debug).CheckProvidedValue("Operating-Version", $version_OS, $debug),

            //The URL of the Player on a Player Panel if available
            "url" => PlayerPanel($server_IP, $persona_ID, CheckUserName($persona_Name)),

            /* A timestamp to be displayed below the embed, IE for when an an article was posted
             * This must be formatted as ISO8601
             */
            "timestamp" => gmdate("Y-m-d\TH:i:s\Z"),

            //The integer color to be used on the left side of the embed
            "color" => hexdec( "FF0000" ),

            //Footer Object: Reporter Footer
            "footer" => [
                "text" => "Eagle Jump • ".$ac_Footer." v".$ac_Version." • FDR Format v3.0",
                "icon_url" => "https://i.eaglejump.org/logos/textless/Eagle%20Jump%20Logo.webp"
            ],
            /*
            //Image Object: Not Used
            "image" => [
                "url" => "https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png"
            ],
            */
            //Thumbnail Object: Gets Event Image
            "thumbnail" => [
                "url" => GetEventImageFromFile($event_Session, EventListLink($server_IP))
            ],

            //Author Object: Server name with Web Site Link
            "author" => [
                "name" => ServerName($server_IP),
                "url" => ServerSiteLink($server_IP)
            ],
            // Field array of objects
            "fields" => [
                //Field: Cheats
                [
                    "name" => "CHEAT",
                    "value" => CheatType($cheat_Type),
                    "inline" => false
                ],
                //Field: Player's Username
                [
                    "name" => "PERSONA",
                    "value" => CheckUserName($persona_Name),
                    "inline" => true
                ],
                //Field: Player's Selected Driver ID
                [
                    "name" => "PERSONA ID",
                    "value" => CheckProvidedValue("Persona-ID", $persona_ID, $debug),
                    "inline" => true
                ],
                //Field: Player's Account ID
                [
                    "name" => "USER ID",
                    "value" => CheckProvidedValue("User-ID", $user_ID, $debug),
                    "inline" => true
                ],
                //Field: Event Name
                [
                    "name" => "EVENT ID ***-> [".CheckProvidedValue("Event-Status", $event_CompletionStatus, $debug)."]***",
                    "value" => GetEventNameFromFile($event_Session, EventListLink($server_IP)),
                    "inline" => true
                ],
                //Field: Car Name
                [
                    "name" => "CAR ID",
                    "value" => CheckProvidedValue("Car-ID", $car_Name, $debug),
                    "inline" => false
                ],
                //Field: HWID
                [
                    "name" => "HARDWARE ID",
                    "value" => CheckProvidedValue("HWID", $hwid_LevelOne, $debug),
                    "inline" => false
                ],
                //Field: Hash
                [
                    "name" => "LAUNCHER HASH",
                    "value" => CheckProvidedValue("Hash", $launcher_Hash, $debug),
                    "inline" => false
                ],
                //Field: Hash
                [
                    "name" => "LAUNCHER HANDSHAKE",
                    "value" => CheckProvidedValue("Key", $launcher_Handshake, $debug),
                    "inline" => false
                ]
            ]
        ]
    ]
];
}

function Json_Format_Version_Four($server_IP, $user_ID, $persona_Name, $persona_ID, $event_Session, $event_CompletionStatus, $cheat_Type, $car_Name, $hwid_LevelOne, $discord_ID, $launcher_Hash, $launcher_Handshake, $launcher_UserAgent, $platform_OS, $version_OS, $ac_Footer, $ac_Version, $debug = false)
{
    return [
    /*
     * The general "message" shown above your embeds
     */
    "content" => "",
    /*
     * The username shown in the message
     */
    "username" => ProfileName($server_IP),
    /*
     * The image location for the senders image
     */
    "avatar_url" => ProfileIconURL($server_IP).'?'.$ac_Version,
    /*
     * Whether or not to read the message in Text-to-speech
     */
    "tts" => false,
    /*
     * File contents to send to upload a file
     */
    // "file" => "",
    /*
     * An array of Embeds
     */
    "embeds" => [
        /*
         * Our first embed
         */
        [
            //Title: Player's Name
            "title" => "Profile for ".CheckUserName($persona_Name),

            //The type of your embed, will ALWAYS be "rich"
            "type" => "rich",

            //The User-Agent of the GameLauncher and Operating System's Name
            "description" => CheckProvidedValue("User-Agent", $launcher_UserAgent, $debug)."\n".CheckProvidedValue("Operating-System", $platform_OS, $debug).CheckProvidedValue("Operating-Version", $version_OS, $debug),

            //The URL of the Player on a Player Panel if available
            "url" => PlayerPanel($server_IP, $persona_ID, CheckUserName($persona_Name)),

            /* A timestamp to be displayed below the embed, IE for when an an article was posted
             * This must be formatted as ISO8601
             */
            "timestamp" => gmdate("Y-m-d\TH:i:s\Z"),

            //The integer color to be used on the left side of the embed
            "color" => hexdec( "FF0000" ),

            //Footer Object: Reporter Footer
            "footer" => [
                "text" => "Eagle Jump • ".$ac_Footer." v".$ac_Version." • FDR Format v4.0",
                "icon_url" => "https://i.eaglejump.org/logos/textless/Eagle%20Jump%20Logo.webp"
            ],
            /*
            //Image Object: Not Used
            "image" => [
                "url" => "https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png"
            ],
            */
            //Thumbnail Object: Gets Event Image
            "thumbnail" => [
                "url" => GetEventImageFromFile($event_Session, EventListLink($server_IP))
            ],

            //Author Object: Server name with Web Site Link
            "author" => [
                "name" => ServerName($server_IP),
                "url" => ServerSiteLink($server_IP)
            ],
            // Field array of objects
            "fields" => [
                //Field: Cheats
                [
                    "name" => "CHEAT",
                    "value" => CheatType($cheat_Type),
                    "inline" => false
                ],
                //Field: Player's Username
                [
                    "name" => "PERSONA",
                    "value" => CheckUserName($persona_Name),
                    "inline" => true
                ],
                //Field: Player's Selected Driver ID
                [
                    "name" => "PERSONA ID",
                    "value" => CheckProvidedValue("Persona-ID", $persona_ID, $debug),
                    "inline" => true
                ],
                //Field: Player's Account ID
                [
                    "name" => "USER ID",
                    "value" => CheckProvidedValue("User-ID", $user_ID, $debug),
                    "inline" => true
                ],
                //Field: Event Name
                [
                    "name" => "EVENT ID ***-> [".CheckProvidedValue("Event-Status", $event_CompletionStatus, $debug)."]***",
                    "value" => GetEventNameFromFile($event_Session, EventListLink($server_IP)),
                    "inline" => true
                ],
                //Field: Car Name
                [
                    "name" => "CAR ID",
                    "value" => CheckProvidedValue("Car-ID", $car_Name, $debug),
                    "inline" => false
                ],
                //Field: HWID
                [
                    "name" => "HARDWARE ID",
                    "value" => CheckProvidedValue("HWID", $hwid_LevelOne, $debug),
                    "inline" => false
                ],
                //Field: HWID
                [
                    "name" => "DISCORD CLIENT ID",
                    "value" => CheckProvidedValue("Discord-ID", $discord_ID, $debug),
                    "inline" => false
                ],
                //Field: Hash
                [
                    "name" => "LAUNCHER HASH",
                    "value" => CheckProvidedValue("Hash", $launcher_Hash, $debug),
                    "inline" => false
                ],
                //Field: Hash
                [
                    "name" => "LAUNCHER HANDSHAKE",
                    "value" => CheckProvidedValue("Key", $launcher_Handshake, $debug),
                    "inline" => false
                ]
            ]
        ]
    ]
];
}
?>