<?php 
require_once (dirname(__FILE__).'/Core/CheatList.php');
require_once (dirname(__FILE__).'/Core/ServerList.php');
require_once (dirname(__FILE__).'/Core/HWID.php');
require_once (dirname(__FILE__).'/Core/EventNameCheck.php');

function url(){
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
parse_str($url_components['query'], $params); 

//Anti-Cheat Reporting Service Build Number
$version = "2.4.b";

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
            // Set the title for your embed
            "title" => "Profile for ".$params['persona_name'],

            // The type of your embed, will ALWAYS be "rich"
            "type" => "rich",

            // A description for your embed
            "description" => $_SERVER['HTTP_USER_AGENT']."\n\n",

            // The URL of where your title will be a link to
            "url" => PlayerPanel($params['serverip'], $params['persona_id'], $params['persona_name']),

            /* A timestamp to be displayed below the embed, IE for when an an article was posted
             * This must be formatted as ISO8601
             */
            "timestamp" => gmdate("Y-m-d\TH:i:s\Z"),

            // The integer color to be used on the left side of the embed
            "color" => hexdec( "FFFFFF" ),

            // Footer object
            "footer" => [
                "text" => "Eagle Jump • Anticheat Reporter v".$version,
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
                "url" => GetEventImageFromFile($params['event_session'], EventListLink($params['serverip']))
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
                    "name" => "CHEAT",
                    "value" => CheatType($params['cheat_type']),
                    "inline" => false
                ],
                // Field 1
                [
                    "name" => "PERSONA",
                    "value" => $params['persona_name'],
                    "inline" => true
                ],
                // Field 2
                [
                    "name" => "PERSONA-ID",
                    "value" => $params['persona_id'],
                    "inline" => true
                ],
                // Field 2
                [
                    "name" => "USER-ID",
                    "value" => $params['user_id'],
                    "inline" => true
                ],
                // Field 3
                [
                    "name" => "EVENT-ID",
                    "value" => GetEventNameFromFile($params['event_session'], EventListLink($params['serverip'])),
                    "inline" => true
                ],
                // Field 2
                [
                    "name" => "HWID",
                    "value" => IsHWIDNull($params['hwid']),
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