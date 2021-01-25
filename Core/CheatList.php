<?php
function CheatType($string) {
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
?>
