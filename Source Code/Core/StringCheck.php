<?php
function LauncherAllowList($string, $debug = false) 
{
    if (!empty($string)) 
	{
        //Official (Full Supported Products)
        if (strpos($string, 'GameLauncher') !== false || strpos($string, 'LegacyLauncher') !== false ||
            strpos($string, 'SBRW Launcher') !== false || strpos($string, 'SBRW Simple Launcher') !== false || $debug)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}

/* Launcher's Version Comparison (String Check: Alert-Status) */
function AlertStatusReportVersion($string, $debug = false)
{
    try
    {
        if(strpos($string, 'GameLauncher') !== false)
        {
                $version_split = explode(" ", $string);
                /* Version 1 */
                if(version_compare($version_split[1], '2.1.6.6', "<="))
                {
                    return "*Launcher Did Not Prevent Cheats for this User*";
                }
                elseif(version_compare($version_split[1], '2.1.7.8', "<=") || version_compare($version_split[1], '3.1.7.7', "=="))
                {
                    return "*Launcher Prevented Cheats for this User*";
                }
                /* Version 2 */
                elseif(version_compare($version_split[1], '2.1.8.8', "<="))
                {
                    return "*After 1 Minute of a Detection\nLauncher Prevented Cheats for this User*";
                }
                /* Version 3 */
                elseif(version_compare($version_split[1], '2.1.9.0002', "<="))
                {
                    return "*After 1 Minute of a Detection\nLauncher Prevented Cheats for this User*";
                }
                /* Version 4 */
                else
                {
                    return "*After 1 Minute of a Detection\nLauncher Prevented Cheats for this User*";
                }
        }
        elseif(strpos($string, 'SBRW Launcher') !== false)
        {
                $version_split = explode(" ", $string);
                /* Version 1 */
                if(version_compare($version_split[2], '2.1.6.6', "<="))
                {
                    return "*Launcher Did Not Prevent Cheats for this User*";
                }
                elseif(version_compare($version_split[2], '2.1.7.8', "<=") || version_compare($version_split[2], '3.1.7.7', "=="))
                {
                    return "*Launcher Prevented Cheats for this User*";
                }
                /* Version 2 */
                elseif(version_compare($version_split[2], '2.1.8.8', "<="))
                {
                    return "*After 1 Minute of a Detection\nLauncher Prevented Cheats for this User*";
                }
                /* Version 3 */
                elseif(version_compare($version_split[2], '2.1.9.0002', "<="))
                {
                    return "*After 1 Minute of a Detection\nLauncher Prevented Cheats for this User*";
                }
                /* Version 4 */
                else
                {
                    return "*After 2 Minutes of a Detection\nLauncher Prevented Cheats for this User*";
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
        elseif($debug == true)
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
    catch (Exception $on_the_fly_error)
    {
        return 'Unknown Server Report Error';
    }
}

function CheckProvidedValue($string, $value, $debug = false) 
{
    if (!empty($value))
	{
        if($string == "User-Agent")
        {
            if (LauncherAllowList($value, $debug))
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
        }
        else if($string == "Alert-Status")
        {
            return AlertStatusReportVersion($value, $debug);
        }
        else if($string == "User-ID" || $string == "Persona-ID" ||
                $string == "Car-ID") 
		{
            return $value;
        }
        else if($string == "Operating-System")
        {
            return "**OPERATING SYSTEM**\n".$value;
        }
        else if($string == "Operating-Version")
        {
            return ' ('.$value.')';
        }
        else if ($string == "Event-Status")
        {
            if(strtolower($value) == "true")
            {
                return 'COMPLETED';
            }
            else
            {
                return 'QUIT';
            }
        }
        else 
		{
            return "||".$value."||";
        }
    }
    else 
	{
        if($string == "Operating-System")
        {
            return "**OPERATING SYSTEM**\nNo Information Provided";
        }
        else if($string == "Operating-Version")
        {
            return NULL;
        }
        else if ($string == "Event-Status")
        {
            return 'COMPLETED';
        }
        else
        {
            return 'No '.$string.' Provided';
        }
    }
}

function CheckUserName($string) 
{        
    if (!empty($string))
	{
        if(strpos($string, utf8_encode('†')) !== false) 
		{
            return str_replace(utf8_encode('†'), '', $string);
        }
        elseif(strpos($string, utf8_encode('?')) !== false) 
		{
            return str_replace(utf8_encode('?'), '', $string);
        }
        elseif(strpos($string, utf8_encode('¤')) !== false) 
		{
            return str_replace(utf8_encode('¤'), '', $string);
        }
        elseif(strpos($string, utf8_encode('[S]')) !== false) 
		{
            return str_replace(utf8_encode('[S]'), '', $string);
        }
        else 
		{
            return $string;
        }
    }
    else
	{
        return 'Username is Null';
    }
}
?>