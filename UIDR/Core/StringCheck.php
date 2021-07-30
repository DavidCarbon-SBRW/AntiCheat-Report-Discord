<?php
function CheckProvidedValue($string, $value)
{
    if (!empty($value))
	{
        if($string == "User-Agent")
        {
            if (strpos($value, 'GameLauncher') !== false || strpos($value, 'LegacyLauncher') !== false || strpos($value, 'SBRW Launcher') !== false || strpos($value, 'SBRW Simple Launcher') !== false)
            {
                return "**LAUNCHER VERSION**\n".$value;
            }
            else
            {
                return "**INVALID REPORT**\nWeb Browser";
            }
        }
        else if($string == "Alert-Status")
        {
            if (strpos($value, 'GameLauncher 2.1.7') !== false || strpos($value, 'GameLauncher 3.1.7') !== false)
            {
                return "*Launcher Prevented Cheats for this User*";
            }
            else if (strpos($value, 'GameLauncher') !== false || strpos($value, 'LegacyLauncher') !== false || strpos($value, 'SBRW Launcher') !== false || strpos($value, 'SBRW Simple Launcher') !== false)
            {
                return "*After 1 Minute of a Detection\nLauncher Prevented Cheats for this User*";
            }
            else
            {
                return "*Who is Testing the Reporter?*";
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