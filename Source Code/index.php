<?php 
require_once (dirname(__FILE__).'/Core/CheatList.php');
require_once (dirname(__FILE__).'/Core/ServerList.php');
require_once (dirname(__FILE__).'/Core/StringCheck.php');
require_once (dirname(__FILE__).'/Core/EventNameCheck.php');
require_once (dirname(__FILE__).'/Core/JsonArrayCreator.php');

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

$development_live = true;
//Anti-Cheat Reporting Service Footer
$development = false;
//Anti-Cheat Reporting Service Build Number
$version = "2.7.b";
//Anti-Cheat Reporting Service Footer
$footer = "Anti-Cheat Reporter";
//
$useAlertFormat = false;
//JSON Format for Discord Embed
$formattedArray = array();
//
$reportFormat = 0;
/* Yes this is Bad Practice, but :shrug: */
$alertPasscode = "DEFAULT_PASS_CODE";
/* No Report, Throw an Error */
$forbiddenError = false;

if(!empty($params['alert_mode']) && !empty($params['alert_access_code']))
{
    if(is_numeric($params['alert_mode']) && ($params['alert_access_code'] == $alertPasscode))
    {
        if ($params['alert_mode'] > 0)
        {
            $useAlertFormat = true;
            $reportFormat = $params['alert_mode'];
            //Upcoming Changes
            $footer = "Anti-Cheat Development Team";
        } 
    }
}

if($development == true && !$useAlertFormat) 
{
	$footer = "Anti-Cheat Reporter Development";
}
elseif($development_live == true)
{
    $footer = "Anti-Cheat Reporter Beta";
}

if((!empty($params['report_format']) || LauncherAllowList($_SERVER['HTTP_USER_AGENT'], $development)) && !$useAlertFormat)
{
    if(!empty($params['report_format']))
    {
        if(is_numeric($params['report_format']) == TRUE)
        {
            if($params['report_format'] >= -4 && $params['report_format'] <= 4)
            {
                $reportFormat = $params['report_format'];
            }
            else
            {
               $reportFormat = -1;
            }
        }
        else
        {
            $reportFormat = -1;
        }
    }
    elseif(!empty($params['report_format_debug']) && $development)
    {
        $reportFormat = FailSafeReportVersionFormat($_SERVER['HTTP_USER_AGENT'], $development, $params['report_format_debug']);
    }
    else
    {
        $reportFormat = FailSafeReportVersionFormat($_SERVER['HTTP_USER_AGENT'], $development);
    }
    
    if($reportFormat == -1)
    {
        $formattedArray = Json_Format_Version_Negative_One($params['serverip'], $params['user_id'], $params['cheat_type'], $params['hwid'], $_SERVER['HTTP_USER_AGENT'], $footer, $version, $development);
    }
    elseif($reportFormat == 1)
    {
        $formattedArray = Json_Format_Version_One($params['serverip'], $params['user_id'], $params['persona_name'], $params['persona_id'], $params['event_session'], $params['cheat_type'], $params['hwid'], $_SERVER['HTTP_USER_AGENT'], $footer, $version, $development);
    }
    elseif($reportFormat == -2)
    {
        $formattedArray = Json_Format_Version_Negative_Two($params['serverip'], $params['user_id'], $params['cheat_type'], $params['hwid'], $params['hwid_fallback'], $params['launcher_hash'], $params['launcher_certificate'], $_SERVER['HTTP_USER_AGENT'], $params['os_platform'], $_SERVER['HTTP_OS_VERSION'], $footer, $version, $development);
    }
    elseif($reportFormat == 2)
    {
        $formattedArray = Json_Format_Version_Two($params['serverip'], $params['user_id'], $params['persona_name'], $params['persona_id'], $params['event_session'], $params['event_status'], $params['cheat_type'], $params['car_used'], $params['hwid'], $params['hwid_fallback'], $params['launcher_hash'], $params['launcher_certificate'], $_SERVER['HTTP_USER_AGENT'], $params['os_platform'], $_SERVER['HTTP_OS_VERSION'], $footer, $version, $development);
    }
    elseif($reportFormat == -3)
    {
        $formattedArray = Json_Format_Version_Negative_Three($params['serverip'], $params['user_id'], $params['cheat_type'], $params['hwid'], $params['launcher_hash'], $params['launcher_certificate'], $_SERVER['HTTP_USER_AGENT'], $params['os_platform'], $_SERVER['HTTP_OS_VERSION'], $footer, $version, $development);
    }
    elseif($reportFormat == 3)
    {
        $formattedArray = Json_Format_Version_Three($params['serverip'], $params['user_id'], $params['persona_name'], $params['persona_id'], $params['event_session'], $params['event_status'], $params['cheat_type'], $params['car_used'], $params['hwid'], $params['launcher_hash'], $params['launcher_certificate'], $_SERVER['HTTP_USER_AGENT'], $params['os_platform'], $_SERVER['HTTP_OS_VERSION'], $footer, $version, $development);
    }
    elseif($reportFormat == -4)
    {
        $formattedArray = Json_Format_Version_Negative_Four($params['serverip'], $params['user_id'], $params['cheat_type'], $params['hwid'], $params['discord_user_id'], $params['launcher_hash'], $params['launcher_certificate'], $_SERVER['HTTP_USER_AGENT'], $params['os_platform'], $_SERVER['HTTP_OS_VERSION'], $footer, $version, $development);
    }
    elseif($reportFormat == 4)
    {
        $formattedArray = Json_Format_Version_Four($params['serverip'], $params['user_id'], $params['persona_name'], $params['persona_id'], $params['event_session'], $params['event_status'], $params['cheat_type'], $params['car_used'], $params['hwid'], $params['discord_user_id'], $params['launcher_hash'], $params['launcher_certificate'], $_SERVER['HTTP_USER_AGENT'], $params['os_platform'], $_SERVER['HTTP_OS_VERSION'], $footer, $version, $development);
    }
    elseif($reportFormat == -4.1)
    {
        $formattedArray = Json_Format_Version_Negative_Four_One($params['serverip'], $params['user_id'], $params['cheat_type'], $params['hwid'], $params['discord_user_id'], $params['launcher_hash'], $params['launcher_certificate'], $_SERVER['HTTP_USER_AGENT'], $params['os_platform'], $_SERVER['HTTP_OS_VERSION'], $footer, $version, $params['ac_ie'], $development);
    }
    elseif($reportFormat == 4.1)
    {
        $formattedArray = Json_Format_Version_Four_One($params['serverip'], $params['user_id'], $params['persona_name'], $params['persona_id'], $params['event_session'], $params['event_status'], $params['cheat_type'], $params['car_used'], $params['hwid'], $params['discord_user_id'], $params['launcher_hash'], $params['launcher_certificate'], $_SERVER['HTTP_USER_AGENT'], $params['os_platform'], $_SERVER['HTTP_OS_VERSION'], $footer, $version, $params['ac_ie'], $development);
    }
    else
    {
        $forbiddenError = true;
    }
}
elseif($useAlertFormat == true)
{
    if($reportFormat == 1)
    {
        $formattedArray = Json_Format_Version_Alert_One($params['serverip'], $params['future_version'], $params['changelog'], $footer, $version, $development);
    }
    else
    {
        $forbiddenError = true;
    }    
}
else
{
    $forbiddenError = true;
}

try
{
    if($forbiddenError == false)
    {
        $hookObject = json_encode($formattedArray, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

        $ch = curl_init();

        curl_setopt_array( $ch, [
            CURLOPT_URL => DiscordChannelHook($params['serverip'], $reportFormat < 0),
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $hookObject,
            CURLOPT_HTTPHEADER => ["Content-Type: application/json"]
        ]);

        $response = curl_exec( $ch );
        curl_close( $ch );
    
        // Display result 
        echo 'Version '.$version;
    }
    else
    {
        // Display result 
        echo 'Forbidden'; 
    }
}
catch (Exception $on_the_fly_error)
{
    // Display result 
    echo 'Internal Server Error';
}
?>