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
        else if($string == "User-ID" || $string == "Operating-System")
		{
            return $value;
        }
        else if($string == "Operating-Version")
        {
            return ' ('.$value.')';
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
        else
        {
            return 'No '.$string.' Provided';
        }
    }
}
?>