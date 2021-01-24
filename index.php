<?php 
require_once (dirname(__FILE__).'/Core/CheatList.php');
require_once (dirname(__FILE__).'/Core/ServerList.php');
require_once (dirname(__FILE__).'/Core/HWID.php');

function url(){
  return sprintf(
    "%s://%s%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME'],
    $_SERVER['REQUEST_URI']
  );
}

echo url();
#=> http://127.0.0.1/foo

// Use parse_url() function to parse the URL 
// and return an associative array which 
// contains its various components 
$url_components = parse_url(url()); 

// Use parse_str() function to parse the 
// string passed via URL 
parse_str($url_components['query'], $params); 

// Replace the URL with your own webhook url
$discordWebhookURL = DiscordChannelHook($params['serverip']);

$nameOfCheat = CheatType($params['cheat_type']);

$hwidNullCheck = IsHWIDNull($params['hwid']);

$hookObject = json_encode([
    /*
     * The general "message" shown above your embeds
     */
    "content" => "",
    /*
     * The username shown in the message
     */
    "username" => "Anti-Cheat",
    /*
     * The image location for the senders image
     */
    "avatar_url" => "https://pbs.twimg.com/profile_images/972154872261853184/RnOg6UyU_400x400.jpg",
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
            "title" => "Google.com",

            // The type of your embed, will ALWAYS be "rich"
            "type" => "rich",

            // A description for your embed
            "description" => "Test",

            // The URL of where your title will be a link to
            "url" => "https://www.google.com/",

            /* A timestamp to be displayed below the embed, IE for when an an article was posted
             * This must be formatted as ISO8601
             */
            "timestamp" => gmdate("Y-m-d\TH:i:s\Z"),

            // The integer color to be used on the left side of the embed
            "color" => hexdec( "FFFFFF" ),

            // Footer object
            "footer" => [
                "text" => "Google TM",
                "icon_url" => "https://i-cdn.davidcarbon.dev/classic/DavidCarbon-Profile-Picture-Remaster.png"
            ],

            // Image object
            "image" => [
                "url" => "https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png"
            ],

            // Thumbnail object
            "thumbnail" => [
                "url" => "https://i-cdn.davidcarbon.dev/classic/DavidCarbon-Profile-Picture-Remaster.png"
            ],

            // Author object
            "author" => [
                "name" => "Powered by DavidCarbon",
                "url" => "https://davidcarbon.dev"
            ],

            // Field array of objects
            "fields" => [
                // Field 4
                [
                    "name" => "CHEAT",
                    "value" => $nameOfCheat,
                    "inline" => false
                ],
                // Field 3
                [
                    "name" => "EVENT-ID",
                    "value" => $params['event_session'],
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
                    "name" => "USER-ID",
                    "value" => $params['user_id'],
                    "inline" => true
                ],
                // Field 2
                [
                    "name" => "HWID",
                    "value" => $hwidNullCheck,
                    "inline" => true
                ]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$ch = curl_init();

curl_setopt_array( $ch, [
    CURLOPT_URL => $discordWebhookURL,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => ["Content-Type: application/json"]
]);

$response = curl_exec( $ch );
curl_close( $ch );
  
// Display result 
echo ' DavidCarbon was Here! '; 

?>