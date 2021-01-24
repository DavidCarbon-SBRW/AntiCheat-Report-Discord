<?php
function CheatType($string) {
        if ($string == '1'){
            return "MultiHack";
        }
	   elseif ($string == '2') {
            return "Fast Powerups";
        }
	   elseif ($string == '4') {
            return "SpeedHack";
        }
	   elseif ($string == '8') {
            return "Smooth Walls";
        }
	   elseif ($string == '16') {
            return "Tanks Mode";
        }
	   elseif ($string == '32') {
            return "WallHack";
        }
	   elseif ($string == '64') {
            return "DriftMod";
        }
	   elseif ($string == '128') {
            return "PursuitBot";
        }
	   elseif ($string == '256') {
            return "ProfileMasker";
        }
	   else {
            return 'Unknown: '.$string;
        }
}
?>