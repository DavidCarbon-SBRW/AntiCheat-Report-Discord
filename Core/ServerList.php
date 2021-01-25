<?php

/* Sets the correct Discord Channel */
function DiscordChannelHook($string) {
    if($string == 'worldonline.pl') {
        //WorldOnline Beta
        return 'WEBHOOK URL';
    }
    elseif($string == 'game.worldunited.gg') {
        //WorldUnited.GG
        return 'WEBHOOK URL';
    }
    elseif($string == 'horizon.nightriderz.world') {
        //NightRiderz
        return 'WEBHOOK URL';
    }
    elseif($string == '92.63.111.195') {
        //World Evolved
        return 'WEBHOOK URL';
    }
    elseif($string == '155.138.131.23') {
        //Underground Stage
        return 'WEBHOOK URL';
    }
    elseif($string == 'core.sparkserver.io') {
        //Freeroam SparkServer
        return 'WEBHOOK URL';
    }
    elseif($string == '209.97.187.156') {
        //WorldUnited.GG Development
        return 'WEBHOOK URL';
    }
    else {
        return 'WEBHOOK URL';
    }
}

/* Provides Server Name */
function ServerName($string) {
    if($string == 'worldonline.pl') {
        //WorldOnline Beta
        return 'WorldOnline Beta - We\'re One Family <3';
    }
    elseif($string == 'game.worldunited.gg') {
        //WorldUnited.GG
        return 'WorldUnited OFFICIAL';
    }
    elseif($string == 'horizon.nightriderz.world') {
        //NightRiderz
        return 'NIGHTRIDERZ | HORIZON';
    }
    elseif($string == '92.63.111.195') {
        //World Evolved
        return 'World Evolved RU';
    }
    elseif($string == '155.138.131.23') {
        //Underground Stage
        return 'UNDERGROUND STAGE';
    }
    elseif($string == 'core.sparkserver.io') {
        //Freeroam SparkServer
        return 'Freeroam Sparkserver';
    }
    elseif($string == '209.97.187.156') {
        //WorldUnited.GG Development
        return 'WorldUnited DEVELOPMENT';
    }
    else {
        return $string;
    }
}

/* Provides Server Links */
function ServerSiteLink($string) {
    if($string == 'worldonline.pl') {
        //WorldOnline Beta
        return 'http://worldonline.pl';
    }
    elseif($string == 'game.worldunited.gg') {
        //WorldUnited.GG
        return 'https://worldunited.gg';
    }
    elseif($string == 'horizon.nightriderz.world') {
        //NightRiderz
        return 'https://nightriderz.world';
    }
    elseif($string == '92.63.111.195') {
        //World Evolved
        return 'http://world-evolved.ru';
    }
    elseif($string == '155.138.131.23') {
        //Underground Stage
        return 'http://undergroundstage.net';
    }
    elseif($string == 'core.sparkserver.io') {
        //Freeroam SparkServer
        return 'https://sparkserver.io';
    }
    elseif($string == '209.97.187.156') {
        //WorldUnited.GG Development
        return 'https://worldunited.gg';
    }    
    else {
        return 'https://davidcarbon.dev';
    }
}

/* Provides File URL for Events */
function EventListLink($string) {
    if($string == 'worldonline.pl') {
        //WorldOnline Beta
        return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/WOPL.json';
    }
    elseif($string == 'game.worldunited.gg') {
        //WorldUnited.GG
        return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/Default.json';
    }
    elseif($string == 'horizon.nightriderz.world') {
        //NightRiderz
        return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/NightRiderz.json';
    }
    elseif($string == '92.63.111.195') {
        //World Evolved
        return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/WE.json';
    }
    elseif($string == '155.138.131.23') {
        //Underground Stage
        return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/UGS.json';
    }
    elseif($string == 'core.sparkserver.io') {
        //Freeroam SparkServer
        return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/FRSS.json';
    }
    else {
        return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/Default.json';
    }
}

?>