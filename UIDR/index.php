<?php 
require_once (dirname(__FILE__).'/Core/CheatList.php');
require_once (dirname(__FILE__).'/Core/ServerList.php');
require_once (dirname(__FILE__).'/Core/StringCheck.php');

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
$version = "2.6.a";
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
			/*
            // Set the title for your embed
            "title" => "Launcher Stopped User",
			*/
            // The type of your embed, will ALWAYS be "rich"
            "type" => "rich",

            // A description for your embed
            "description" => CheckProvidedValue("User-Agent", $_SERVER['HTTP_USER_AGENT'])."\n".CheckProvidedValue("Operating-System", $params['os_platform']).CheckProvidedValue("Operating-Version", $_SERVER['HTTP_OS_VERSION']),

			/*
            // The URL of where your title will be a link to
            "url" => ServerSiteLink($params['serverip']),
			*/
            /* A timestamp to be displayed below the embed, IE for when an an article was posted
             * This must be formatted as ISO8601
             */
            "timestamp" => gmdate("Y-m-d\TH:i:s\Z"),

            // The integer color to be used on the left side of the embed
            "color" => hexdec( "FAB440" ),

            // Footer object
            "footer" => [
                "text" => "Eagle Jump • ".$footer." v".$version,
                "icon_url" => "https://i.eaglejump.org/logos/textless/Eagle%20Jump%20Logo.webp"
            ],
            /*
            // Image object
            "image" => [
                "url" => "https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png"
            ],
            */
            // Thumbnail object
            "thumbnail" => [
                "url" => "https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/IMG/gamemode_unknown.png"
            ],

            // Author object
            "author" => [
                "name" => ServerName($params['serverip']),
                "url" => ServerSiteLink($params['serverip'])
            ],
            // Field array of objects
            "fields" => [
                // Field 4
                [
                    "name" => "ALERT",
                    "value" => "*Launcher Prevented Cheats for this User*",
                    "inline" => false
                ],
                // Field 4
                [
                    "name" => "CHEAT",
                    "value" => CheatType($params['cheat_type']),
                    "inline" => false
                ],
                // Field 2
                [
                    "name" => "USER-ID",
                    "value" => CheckProvidedValue("User-ID", $params['user_id']),
                    "inline" => true
                ],
                // Field 2
                [
                    "name" => "LEVEL 1 HWID",
                    "value" => CheckProvidedValue("HWID", $params['hwid']),
                    "inline" => false
                ],
                // Field 2
                [
                    "name" => "LEVEL 2 HWID",
                    "value" => CheckProvidedValue("HWID", $params['hwid_fallback']),
                    "inline" => false
                ],
                // Field 2
                [
                    "name" => "LAUNCHER HASH",
                    "value" => CheckProvidedValue("Hash", $params['launcher_hash']),
                    "inline" => false
                ],
                // Field 2
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