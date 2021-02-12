<?php
/* Sets the correct Discord Channel */
function ProfileIconURL($string) {
    if($string == 'worldonline.pl') {
        //WorldOnline Beta
        return 'https://i.eaglejump.org/team/Nene%20Sakura.webp';
    }
    elseif($string == 'game.worldunited.gg') {
        //WorldUnited.GG
        return 'https://i.eaglejump.org/team/Christina%20Wako%20Yamato.webp';
    }
    elseif($string == 'horizon.nightriderz.world') {
        //NightRiderz
        return 'https://i.eaglejump.org/team/Rin%20Toyama.webp';
    }
    elseif($string == '92.63.111.195') {
        //World Evolved
        return 'https://i.eaglejump.org/team/Momiji%20Mochizuki.webp';
    }
    elseif($string == '155.138.131.23') {
        //Underground Stage
        return 'https://i.eaglejump.org/team/Tsubame%20Narumi.webp';
    }
    elseif($string == 'core.sparkserver.io') {
        //Freeroam SparkServer
        return 'https://i.eaglejump.org/team/Yun%20Iijima.webp';
    }
    elseif($string == '209.97.187.156') {
        //WorldUnited.GG Development
        return 'https://i.eaglejump.org/team/Christina%20Wako%20Yamato.webp';
    }
    else {
        return 'https://i.eaglejump.org/team/Aoba%20Suzukaze.webp';
    }
}
?>