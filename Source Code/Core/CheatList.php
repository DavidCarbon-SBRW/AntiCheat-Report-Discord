<?php
function CheatType($string)
{
    if(is_numeric($string) == TRUE)
	{
        if($string == -1)
        {
            return "Anti-Cheat Not Initialized";
        }
        elseif($string > 0 && $string <= 1023)
		{
            $i = 0;
            $cheattype = array("Ghosting", "Profile Masker", "Pursuit Bot", "Handling Modifier", "Wallhack", "Tank Mode", "Smooth Walls", "Speedhack", "Fast Powerups", "MultiHack");
            $detected = str_split(sprintf("%10d", decbin($string)));
            
            foreach($detected as $int)
			{
                if($int == 1)
				{
                    $ret[] = $cheattype[$i];
				}
                
				$i++;
            }
            
            return implode(", ", $ret);
        }
        else
		{
            return "Unknown: [".$string."]";
        }
    }
    else
	{
        if(!empty($string))
		{
            return "Unknown: [".$string."]";
        }
        else
		{
            return "Unknown: [NULL]";
        }
    }
}
?>
