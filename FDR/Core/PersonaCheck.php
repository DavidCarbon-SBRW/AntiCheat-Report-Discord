<?php
function CheckProvidedValue($string, $value) 
{
    if (!empty($value)) 
	{
        if($string == "User-ID" || $string == "Persona-ID") 
		{
            return $value;
        }
        else 
		{
            return "||".$value."||";
        }
    }
    else 
	{
        return 'No '.$string.' Provided';
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