<?php

/* Sets the correct Discord Channel */
function DiscordChannelHook($string)
{
    if($string == 'worldonline.pl')
	{
        //WorldOnline Beta
        return 'WEBHOOK URL';
    }
    elseif($string == 'game.worldunited.gg')
	{
        //WorldUnited.GG
        return 'WEBHOOK URL';
    }
    elseif($string == 'horizon.nightriderz.world')
	{
        //NightRiderz
        return 'WEBHOOK URL';
    }
    elseif($string == '92.63.111.195')
	{
        //World Evolved
        return 'WEBHOOK URL';
    }
    elseif($string == '155.138.131.23')
	{
        //Underground Stage
        return 'WEBHOOK URL';
    }
    elseif($string == 'core.sparkserver.io')
	{
        //Freeroam SparkServer
        return 'WEBHOOK URL';
    }
    elseif($string == '209.97.187.156')
	{
        //WorldUnited.GG Development
        return 'WEBHOOK URL';
    }
    else
	{
        return 'WEBHOOK URL';
    }
}

/* Provides Server Name */
function ServerName($string)
{
    if($string == 'worldonline.pl')
	{
        //WorldOnline Beta
        return 'WorldOnline Beta - We\'re One Family <3';
    }
    elseif($string == 'game.worldunited.gg')
	{
        //WorldUnited.GG
        return 'WorldUnited OFFICIAL';
    }
    elseif($string == 'horizon.nightriderz.world')
	{
        //NightRiderz
        return 'NIGHTRIDERZ | HORIZON';
    }
    elseif($string == '92.63.111.195')
	{
        //World Evolved
        return 'World Evolved RU';
    }
    elseif($string == '155.138.131.23')
	{
        //Underground Stage
        return 'UNDERGROUND STAGE';
    }
    elseif($string == 'core.sparkserver.io')
	{
        //Freeroam SparkServer
        return 'Freeroam Sparkserver';
    }
    elseif($string == '209.97.187.156')
	{
        //WorldUnited.GG Development
        return 'WorldUnited DEVELOPMENT';
    }
    else
	{
        return $string;
    }
}

/* Provides Server Links */
function ServerSiteLink($string)
{
    if($string == 'worldonline.pl')
	{
        //WorldOnline Beta
        return 'http://worldonline.pl';
    }
    elseif($string == 'game.worldunited.gg')
	{
        //WorldUnited.GG
        return 'https://worldunited.gg';
    }
    elseif($string == 'horizon.nightriderz.world')
	{
        //NightRiderz
        return 'https://nightriderz.world';
    }
    elseif($string == '92.63.111.195')
	{
        //World Evolved
        return 'http://world-evolved.ru';
    }
    elseif($string == '155.138.131.23')
	{
        //Underground Stage
        return 'http://undergroundstage.net';
    }
    elseif($string == 'core.sparkserver.io')
	{
        //Freeroam SparkServer
        return 'https://sparkserver.io';
    }
    elseif($string == '209.97.187.156')
	{
        //WorldUnited.GG Development
        return 'https://worldunited.gg';
    }    
    else
	{
        return 'https://davidcarbon.dev';
    }
}

/* Provides File URL for Events */
function EventListLink($string, $json_type)
{
    if($string == 'worldonline.pl')
	{
        //WorldOnline Beta
        return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/'.$json_type.'/WOPL.json';
    }
    elseif($string == 'game.worldunited.gg')
	{
        //WorldUnited.GG
        return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/'.$json_type.'/Default.json';
    }
    elseif($string == 'horizon.nightriderz.world')
	{
        //NightRiderz
        return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/'.$json_type.'/NightRiderz.json';
    }
    elseif($string == '92.63.111.195')
	{
        //World Evolved
        return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/'.$json_type.'/WE.json';
    }
    elseif($string == '155.138.131.23')
	{
        //Underground Stage
        return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/'.$json_type.'/UGS.json';
    }
    elseif($string == 'core.sparkserver.io')
	{
        //Freeroam SparkServer
        return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/'.$json_type.'/FRSS.json';
    }
    else
	{
        return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/'.$json_type.'/Default.json';
    }
}

/* Provides Public Profile Links (Panel) */
function PlayerPanel($ServerDNS, $PersonaID, $PersonaName)
{
    if($ServerDNS == 'worldonline.pl')
	{
        //WorldOnline Beta
        return 'http://worldonline.pl/panelik/profile.php?id='.$PersonaID;
    }
    elseif($ServerDNS == 'game.worldunited.gg')
	{
        //WorldUnited.GG
        return 'https://panel.worldunited.gg/drivers/'.$PersonaName;
    }
    elseif($ServerDNS == 'horizon.nightriderz.world')
	{
        //NightRiderz
        return 'https://nightriderz.world/player/driver/'.$PersonaID;
    }
    elseif($ServerDNS == '92.63.111.195')
	{
        //World Evolved
        return 'http://world-evolved.ru/en/stats/profiles/'.$PersonaName;
    }
    elseif($ServerDNS == '155.138.131.23')
	{
        //Underground Stage
        return 'https://nfsranks.undergroundstage.net/drivers/'.$PersonaName;
    }
    elseif($ServerDNS == 'core.sparkserver.io')
	{
        //Freeroam SparkServer
        return 'https://ranks.sparkserver.io/drivers/'.$PersonaID;
    }
    else
	{
        return 'https://discord.com/channels/802799152378675220/802799540100923393';
    }
}

/* Sets the correct Discord Channel */
function ProfileIconURL($string)
{
    if($string == 'worldonline.pl')
	{
        //WorldOnline Beta
        return 'https://i.eaglejump.org/team/Nene%20Sakura.webp';
    }
    elseif($string == 'game.worldunited.gg') 
	{
        //WorldUnited.GG
        return 'https://i.eaglejump.org/team/Christina%20Wako%20Yamato.webp';
    }
    elseif($string == 'horizon.nightriderz.world')
	{
        //NightRiderz
        return 'https://i.eaglejump.org/team/Rin%20Toyama.webp';
    }
    elseif($string == '92.63.111.195')
	{
        //World Evolved
        return 'https://i.eaglejump.org/team/Momiji%20Mochizuki.webp';
    }
    elseif($string == '155.138.131.23')
	{
        //Underground Stage
        return 'https://i.eaglejump.org/team/Tsubame%20Narumi.webp';
    }
    elseif($string == 'core.sparkserver.io')
	{
        //Freeroam SparkServer
        return 'https://i.eaglejump.org/team/Yun%20Iijima.webp';
    }
    elseif($string == '209.97.187.156')
	{
        //WorldUnited.GG Development
        return 'https://i.eaglejump.org/team/Christina%20Wako%20Yamato.webp';
    }
    else
	{
        return 'https://i.eaglejump.org/team/Aoba%20Suzukaze.webp';
    }
}

/* Sets Name for certain servers */
function ProfileName($string)
{
    if($string == 'worldonline.pl')
	{
        //WorldOnline Beta
        return 'Nene: Anti-Cheat';
    }
    elseif($string == 'game.worldunited.gg')
	{
        //WorldUnited.GG
        return 'Christina: Anti-Cheat';
    }
    elseif($string == 'horizon.nightriderz.world')
	{
        //NightRiderz
        return 'Rin: Anti-Cheat';
    }
    elseif($string == '92.63.111.195')
	{
        //World Evolved
        return 'Momiji: Anti-Cheat';
    }
    elseif($string == '155.138.131.23')
	{
        //Underground Stage
        return 'Tsubame: Anti-Cheat';
    }
    elseif($string == 'core.sparkserver.io')
	{
        //Freeroam SparkServer
        return 'Yun: Anti-Cheat';
    }
    elseif($string == '209.97.187.156')
	{
        //WorldUnited.GG Development
        return 'Christina: Anti-Cheat';
    }
    else
	{
        return 'Aoba: Anti-Cheat';
    }
}
?>