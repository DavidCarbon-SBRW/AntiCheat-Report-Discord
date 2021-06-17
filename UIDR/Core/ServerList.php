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