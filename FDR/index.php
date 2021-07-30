<?php 
require_once (dirname(__FILE__).'/Core/CheatList.php');
require_once (dirname(__FILE__).'/Core/ServerList.php');
require_once (dirname(__FILE__).'/Core/StringCheck.php');
require_once (dirname(__FILE__).'/Core/EventNameCheck.php');

function url()
{
  return sprintf(
    "%s://%s%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME'],
    $_SERVER['REQUEST_URI']
  );
}

//echo url();
#=> http://127.0.0.1/foo

// Use parse_url() function to parse the URL 
// and return an associative array which 
// contains its various components 
$url_components = parse_url(url()); 

// Use parse_str() function to parse the 
// string passed via URL 
parse_str(utf8_encode($url_components['query']), $params); 

//Anti-Cheat Reporting Service Footer
$development = false;
//Anti-Cheat Reporting Service Build Number
$version = "2.6.d";
//Anti-Cheat Reporting Service Footer
$footer = "Anticheat Reporter";
if($development == true) 
{
	$footer = "Anticheat Reporter Development";
}

$hookObject = json_encode([
    /*
     * The general "message" shown above your embeds
     */
    "content" => "",
    /*
     * The username shown in the message
     */
    "username" => ProfileName($params['serverip']),
    /*
     * The image location for the senders image
     */
    "avatar_url" => ProfileIconURL($params['serverip']).'?'.$version,
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
            "title" => "Profile for ".CheckUserName($params['persona_name']),

            //The type of your embed, will ALWAYS be "rich"
            "type" => "rich",

            //The User-Agent of the GameLauncher and Operating System's Name
            "description" => CheckProvidedValue("User-Agent", $_SERVER['HTTP_USER_AGENT'])."\n".CheckProvidedValue("Operating-System", $params['os_platform']).CheckProvidedValue("Operating-Version", $_SERVER['HTTP_OS_VERSION']),

            //The URL of the Player on a Player Panel if available
            "url" => PlayerPanel($params['serverip'], $params['persona_id'], CheckUserName($params['persona_name'])),

            /* A timestamp to be displayed below the embed, IE for when an an article was posted
             * This must be formatted as ISO8601
             */
            "timestamp" => gmdate("Y-m-d\TH:i:s\Z"),

            //The integer color to be used on the left side of the embed
            "color" => hexdec( "FF0000" ),

            //Footer Object: Reporter Footer
            "footer" => [
                "text" => "Eagle Jump • ".$footer." v".$version,
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
                "url" => GetEventImageFromFile($params['event_session'], EventListLink($params['serverip']))
            ],

            //Author Object: Server name with Web Site Link
            "author" => [
                "name" => ServerName($params['serverip']),
                "url" => ServerSiteLink($params['serverip'])
            ],
            // Field array of objects
            "fields" => [
                //Field: Cheats
                [
                    "name" => "CHEAT",
                    "value" => CheatType($params['cheat_type']),
                    "inline" => false
                ],
                //Field: Player's Username
                [
                    "name" => "PERSONA",
                    "value" => CheckUserName($params['persona_name']),
                    "inline" => true
                ],
                //Field: Player's Selected Driver ID
                [
                    "name" => "PERSONA-ID",
                    "value" => CheckProvidedValue("Persona-ID", $params['persona_id']),
                    "inline" => true
                ],
                //Field: Player's Account ID
                [
                    "name" => "USER-ID",
                    "value" => CheckProvidedValue("User-ID", $params['user_id']),
                    "inline" => true
                ],
                //Field: Event Name
                [
                    "name" => "EVENT-ID ***-> [".CheckProvidedValue("Event-Status", $params['event_status'])."]***",
                    "value" => GetEventNameFromFile($params['event_session'], EventListLink($params['serverip'])),
                    "inline" => true
                ],
                //Field: Car Name
                [
                    "name" => "CAR-ID",
                    "value" => CheckProvidedValue("Car-ID", $params['car_used']),
                    "inline" => false
                ],
                //Field: HWID
                [
                    "name" => "LEVEL 1 HWID",
                    "value" => CheckProvidedValue("HWID", $params['hwid']),
                    "inline" => false
                ],
                //Field: HWID
                [
                    "name" => "LEVEL 2 HWID",
                    "value" => CheckProvidedValue("HWID", $params['hwid_fallback']),
                    "inline" => false
                ],
                //Field: Hash
                [
                    "name" => "LAUNCHER HASH",
                    "value" => CheckProvidedValue("Hash", $params['launcher_hash']),
                    "inline" => false
                ],
                //Field: Hash
                [
                    "name" => "LAUNCHER HANDSHAKE",
                    "value" => CheckProvidedValue("Key", $params['launcher_certificate']),
                    "inline" => false
                ]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$ch = curl_init();

curl_setopt_array( $ch, [
    CURLOPT_URL => DiscordChannelHook($params['serverip']),
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => ["Content-Type: application/json"]
]);

$response = curl_exec( $ch );
curl_close( $ch );
  
// Display result 
echo ' 100% Electric '; 

?>