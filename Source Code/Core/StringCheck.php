<?php
function LauncherAllowList($string, $debug = false) 
{
    if (!empty($string)) 
	{
        //Official (Full Supported Products)
        if (strpos($value, 'GameLauncher') !== false || strpos($value, 'LegacyLauncher') !== false ||
            strpos($value, 'SBRW Launcher') !== false || strpos($value, 'SBRW Simple Launcher') !== false || $debug)
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
        else if($string == "User-ID" || $string == "Persona-ID" ||
                $string == "Car-ID" || $string == "Discord-ID") 
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