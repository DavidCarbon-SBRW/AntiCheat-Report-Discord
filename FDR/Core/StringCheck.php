<?php
function CheckProvidedValue($string, $value) 
{
    if (!empty($value)) 
	{
        if($string == "User-Agent")
        {
            if (strpos($value, 'GameLauncher') !== false) 
            {
                return $value;
            }
            else
            {
                return "**INVALID REPORT**\nWeb Browser";
            }
        }
        else if($string == "User-ID" || $string == "Persona-ID" || $string == "Operating-System") 
		{
            return $value;
        }
        else if($string == "Operating-Version")
        {
            return ' ('.$value.')';
        }
        else if ($string == "Event-Status")
        {
            if($value == "true")
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
        if($string == "Operating-Version")
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