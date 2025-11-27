<?php

/* Sets the correct Discord Channel */
function DiscordChannelHook($server_Data, $separate_channel_UID = false)
{
    return $separate_channel_UID ? $server_Data['webhooks']['user_id_details'] : $server_Data['webhooks']['full_details'];
}

/* Provides Server Name */
function ServerName($server_Data)
{
    return $server_Data['name'];
}

/* Provides Server Links */
function ServerSiteLink($server_Data)
{
    return $server_Data['site'];
}

/* Provides File URL for Events */
function EventListLink($server_Data)
{
    return $server_Data['event_json'];
}

/* Provides Public Profile Links (Panel) */
function PlayerPanel($server_Data, $PersonaID, $PersonaName)
{
    $panel = $server_Data['panel'];

    if ($panel['persona_type'] === 'static')
    {
        return $panel['url'];
    }
    else if ($panel['persona_type'] === 'id')
    {
        return sprintf($panel['url'], $PersonaID);
    }
    else
    {
        // Default to Name
        return sprintf($panel['url'], $PersonaName);
    }
}

/* Sets the correct Discord Channel */
function ProfileIconURL($server_Data)
{
    return $server_Data['avatar_url'];
}

/* Sets Name for certain servers */
function ProfileName($server_Data)
{;
    return $server_Data['username'];
}

/**
 * ServerRegistry
 * * Centralized configuration for all server-specific data.
 * To add a new server, simply add a new entry to the $servers array.
 */
class ServerRegistry
{
    private static $defaultConfig = [
        'webhooks' => [
            'full_details'   => 'https://discord.com/api/webhooks/',
            'user_id_details' => 'https://discord.com/api/webhooks/'
        ],
        'name'         => null, // Will fallback to input string
        'site'         => 'https://davidcarbon.dev',
        'event_json'   => 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/Events/Default.json',
        'panel'        => ['url' => 'https://eaglejump.org/', 'persona_type' => 'static'],
        'avatar_url'         => 'https://i.eaglejump.org/team/Aoba%20Suzukaze.webp',
        'username' => 'Aoba: Anti-Cheat'
    ];

    private static $servers = [
        'worldonline' => [
            'identifiers' => ['worldonline.pl'],
            'webhooks' => [
                'full_details'   => 'https://discord.com/api/webhooks/',
                'user_id_details' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'WorldOnline',
            'site'         => 'http://worldonline.pl',
            'event_json'   => 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/Events/WOPL.json',
            'panel'        => ['url' => 'http://ap.worldonline.pl/driver/%s', 'persona_type' => 'name'],
            'avatar_url'         => 'https://i.eaglejump.org/team/Nene%20Sakura.webp',
            'username' => 'Nene: Anti-Cheat'
        ],
        'worldunited' => [
            'identifiers' => ['game.worldunited.gg', '51.161.118.213'],
            'webhooks' => [
                'full_details'   => 'https://discord.com/api/webhooks/',
                'user_id_details' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'WorldUnited OFFICIAL',
            'site'         => 'https://worldunited.gg',
            'event_json'   => 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/Events/WorldUnitedGG.json',
            'panel'        => ['url' => 'https://panel.worldunited.gg/drivers/%s', 'persona_type' => 'name'],
            'avatar_url'         => 'https://i.eaglejump.org/team/Christina%20Wako%20Yamato.webp',
            'username' => 'Christina: Anti-Cheat'
        ],
        'worldunited_dev' => [
            'identifiers' => ['209.97.187.156', '144.126.250.247'],
            'webhooks' => [
                'full_details'   => 'https://discord.com/api/webhooks/',
                'user_id_details' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'WorldUnited DEVELOPMENT',
            'site'         => 'https://worldunited.gg',
            'event_json'   => 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/Events/WorldUnitedGG.json', // Assuming same events as main
            'panel'        => ['url' => 'https://panel.worldunited.gg/drivers/%s', 'persona_type' => 'name'],
            'avatar_url'         => 'https://i.eaglejump.org/team/Christina%20Wako%20Yamato.webp',
            'username' => 'Christina: Anti-Cheat'
        ],
        'nightriderz_horizon' => [
            'identifiers' => ['horizon.nightriderz.world', '142.132.196.182'],
            'webhooks' => [
                'full_details'   => 'https://discord.com/api/webhooks/',
                'user_id_details' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'NIGHTRIDERZ: Horizon',
            'site'         => 'https://nightriderz.world',
            'event_json'   => 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/Events/NightRiderz.json',
            'panel'        => ['url' => 'https://nightriderz.world/player/driver/%s', 'persona_type' => 'id'],
            'avatar_url'         => 'https://i.eaglejump.org/team/Rin%20Toyama.webp',
            'username' => 'Rin: Anti-Cheat'
        ],
        'nightriderz_lab' => [
            'identifiers' => ['thelab.nightriderz.world', '89.234.180.231', 'core.thelab.nightriderz.world'],
            'webhooks' => [
                'full_details'   => 'https://discord.com/api/webhooks/',
                'user_id_details' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'NIGHTRIDERZ: The lab',
            'site'         => 'https://core.thelab.nightriderz.world',
            'event_json'   => 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/Events/NightRiderz.json',
            'panel'        => ['url' => 'https://nightriderz.world', 'persona_type' => 'static'],
            'avatar_url'         => 'https://i.eaglejump.org/team/Rin%20Toyama.webp',
            'username' => 'Rin: Anti-Cheat'
        ],
        'worldevolved' => [
            'identifiers' => ['92.63.111.195', '45.133.216.224'],
            'webhooks' => [
                'full_details'   => 'https://discord.com/api/webhooks/',
                'user_id_details' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'World Evolved RU',
            'site'         => 'http://world-evolved.ru',
            'event_json'   => 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/Events/WE.json',
            'panel'        => ['url' => 'http://world-evolved.ru/en/stats/profiles/%s', 'persona_type' => 'name'],
            'avatar_url'         => 'https://i.eaglejump.org/team/Momiji%20Mochizuki.webp',
            'username' => 'Momiji: Anti-Cheat'
        ],
        'undergroundstage' => [
            'identifiers' => ['155.138.131.23', 'core.undergroundstage.net'],
            'webhooks' => [
                'full_details'   => 'https://discord.com/api/webhooks/',
                'user_id_details' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'UNDERGROUND STAGE',
            'site'         => 'http://undergroundstage.net',
            'event_json'   => 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/Events/UGS.json',
            'panel'        => ['url' => 'https://nfsranks.undergroundstage.net/drivers/%s', 'persona_type' => 'name'],
            'avatar_url'         => 'https://i.eaglejump.org/team/Tsubame%20Narumi.webp',
            'username' => 'Tsubame: Anti-Cheat'
        ],
        'sparkserver' => [
            'identifiers' => ['core.sparkserver.io', '138.201.247.232'],
            'webhooks' => [
                'full_details'   => 'https://discord.com/api/webhooks/',
                'user_id_details' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'Sparkserver',
            'site'         => 'https://sparkserver.io',
            'event_json'   => 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/Events/FRSS.json',
            'panel'        => ['url' => 'https://ranks.sparkserver.io/drivers/%s', 'persona_type' => 'id'],
            'avatar_url'         => 'https://i.eaglejump.org/team/Yun%20Iijima.webp',
            'username' => 'Yun: Anti-Cheat'
        ],
        'overdrive' => [
            'identifiers' => ['66.11.123.232', 'overdriveworld.com', '40.160.225.21'],
            'webhooks' => [
                'full_details'   => 'https://discord.com/api/webhooks/',
                'user_id_details' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'OVERDRIVE',
            'site'         => 'https://overdriveworld.com',
            'event_json'   => 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/Events/Default.json',
            'panel'        => ['url' => 'https://overdriveworld.com/drivers/%s', 'persona_type' => 'name'],
            'avatar_url'         => 'https://i.eaglejump.org/team/Shizuku%20Hazuki.webp',
            'username' => 'Shizuku: Anti-Cheat'
        ],
        'davidcarbon_dev' => [
            'identifiers' => [], // Special logic handled in resolve()
            'webhooks' => [
                'full_details'   => null, // Uses default
                'user_id_details' => null  // Uses default
            ],
            'name'         => 'Debug Report - Test Processed',
            'site'         => 'https://davidcarbon.dev',
            'event_json'   => 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/Events/Default.json',
            'panel'        => ['url' => 'https://eaglejump.org/', 'persona_type' => 'static'],
            'avatar_url'         => 'https://i.eaglejump.org/team/Umiko%20Ahagon.webp',
            'username' => 'Umiko: Anti-Cheat'
        ]
    ];

    /**
     * Resolves the server config based on the input string (IP or Domain)
     */
    public static function get($string)
    {
        // 1. Direct Lookup
        foreach (self::$servers as $key => $config)
        {
            if (in_array($string, $config['identifiers'])) 
            {
                return array_merge(self::$defaultConfig, $config);
            }
        }

        // 2. DavidCarbon / Dev Check Logic
        if ((strpos($string, 'davidcarbon') !== false && (strpos($string, '.dev') !== false || strpos($string, '.download') !== false)) || 
            (strpos($string, '.org') !== false && (strpos($string, 'carboncrew') !== false || strpos($string, 'eaglejump') !== false))) 
        {
            $config = self::$servers['davidcarbon_dev'];
            // Explicitly set webhooks to default if null, or inherit
            $finalConfig = array_merge(self::$defaultConfig, $config);
            if ($config['webhooks']['full_details'] === null)
            {
                $finalConfig['webhooks'] = self::$defaultConfig['webhooks'];
            }
            return $finalConfig;
        }
        else
        {
            // 3. Fallback
            $unknownServerConfig = [
                'name'         => ($string == null ? 'Unknown Server' : $string)
            ];
            
            // Explicitly set serverIP as default
            $finalConfig = array_merge(self::$defaultConfig, $unknownServerConfig);
            
            return $finalConfig;
        }
    }
}
?>