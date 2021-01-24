<?php 

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
//$url_components = parse_url("https://blog.davidcarbon.dev/report?serverip=worldonline.pl&user_id=91977&persona_name=DavidCarbon&event_session=502&cheat_type=0&hwid=AE2B21EA65C367A152F41137E33A3836FF938497"); 

$url_components = parse_url(url()); 

// Use parse_str() function to parse the 
// string passed via URL 
parse_str($url_components['query'], $params); 

// Display result 
echo ' Hi '.$params['serverip'].$params['user_id'].$params['persona_name'].$params['event_session'].$params['cheat_type'].$params['hwid']; 

// Replace the URL with your own webhook url
$discordWebhookURL = "https://discord.com/api/webhooks/";

$nameOfCheat = "ERROR"; 

function whichDiscord(){
        
    if($params['serverip'] != null){
        
        global $discordWebhookURL;
        
        if($params['serverip'] == "worldonline.pl") {
            //WorldOnline Beta
            $discordWebhookURL = "https://discord.com/api/";
        }
        elseif($params['serverip'] == "game.worldunited.gg") {
            //WorldUnited.GG
            $discordWebhookURL = "https://discord.com/api/";
        }
        elseif($params['serverip'] == "horizon.nightriderz.world") {
            //NightRiderz
            $discordWebhookURL = "https://discord.com/api/";
        }
        elseif($params['serverip'] == "92.63.111.195") {
            //World Evolved
            $discordWebhookURL = "https://discord.com/api/";
        }
        elseif($params['serverip'] == "155.138.131.23") {
            //Underground Stage
            $discordWebhookURL = "https://discord.com/api/";
        }
        elseif($params['serverip'] == "core.sparkserver.io") {
            //Freeroam SparkServer
            $discordWebhookURL = "https://discord.com/api/";
        }
        else {
            $discordWebhookURL = "https://discord.com/api/";
        } 
    }
        
    if($params['cheat_type'] != null){
        
        global $nameOfCheat;
        
       if ($params['cheat_type'] == "1"){
            $nameOfCheat = "MultiHack";
        }
	   elseif ($params['cheat_type'] == "2") {
            $nameOfCheat = "Fast Powerups";
        }
	   elseif ($params['cheat_type'] == "4") {
            $nameOfCheat = "SpeedHack";
        }
	   elseif ($params['cheat_type'] == "8") {
            $nameOfCheat = "Smooth Walls";
        }
	   elseif ($params['cheat_type'] == "16") {
            $nameOfCheat = "Tanks Mode";
        }
	   elseif ($params['cheat_type'] == "32") {
            $nameOfCheat = "WallHack";
        }
	   elseif ($params['cheat_type'] == "64") {
            $nameOfCheat = "DriftMod";
        }
	   elseif ($params['cheat_type'] == "128") {
            $nameOfCheat = "PursuitBot";
        }
	   elseif ($params['cheat_type'] == "256") {
            $nameOfCheat = "ProfileMasker";
        }
	   else {
            $nameOfCheat = "UNKNOWN";
        }
    }
}

whichDiscord();

$hookObject = json_encode([
    /*
     * The general "message" shown above your embeds
     */
    "content" => "A message will go here",
    /*
     * The username shown in the message
     */
    "username" => "MyUsername",
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
            "description" => "",

            // The URL of where your title will be a link to
            "url" => "https://www.google.com/",

            /* A timestamp to be displayed below the embed, IE for when an an article was posted
             * This must be formatted as ISO8601
             */
            "timestamp" => date("Y-m-d\TH:i:s.000\Z"),

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
                "url" => "https://pbs.twimg.com/profile_images/972154872261853184/RnOg6UyU_400x400.jpg"
            ],

            // Author object
            "author" => [
                "name" => "Powered by DavidCarbon",
                "url" => "https://davidcarbon.dev"
            ],

            // Field array of objects
            "fields" => [
                // Field 1
                [
                    "name" => "USER-ID",
                    "value" => "Value A",
                    "inline" => false
                ],
                // Field 2
                [
                    "name" => "USERNAME",
                    "value" => "Value B",
                    "inline" => true
                ],
                // Field 3
                [
                    "name" => "EVENT-ID",
                    "value" => "Value C",
                    "inline" => true
                ],
                // Field 4
                [
                    "name" => "CHEAT",
                    "value" => "TEST",
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
echo ' Thanks for the Report! '; 

?>