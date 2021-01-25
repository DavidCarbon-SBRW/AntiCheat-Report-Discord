<?php
function CheatType($string) {
    if($string == 0) {
        return "Unknown: [0]";
    }
    elseif(is_numeric($string) == TRUE) {
        if($string <= 1023) {
            $i = 0;
            $cheattype = array("TreasureHuntReveal", "ProfileMasker", "NoCops", "DriftMods", "Wallhack", "TankMode", "SmoothWalls", "Speedhack", "FastPowerups", "MultiHack");
            $detected = str_split(sprintf("%10d", decbin($string)));
            
            foreach($detected as $int) {
                if($int == 1) {
                    $ret[] = $cheattype[$i];
            }
                
            $i++;
            }
            
            return implode(", ", $ret);
        }
        else {
            return "Unknown: [".$string."]";
        }
    }
    else {
        if(!empty($string)) {
            return "Unknown: [".$string."]";
        }
        else {
            return "Unknown: [NULL]";
        }
    }
}
?>
