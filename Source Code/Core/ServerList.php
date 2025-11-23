<?php

/**
 * ServerRegistry
 * * Centralized configuration for all server-specific data.
 * To add a new server, simply add a new entry to the $servers array.
 */
class ServerRegistry
{
    private static $defaultConfig = [
        'webhooks' => [
            'normal'   => 'https://discord.com/api/webhooks/',
            'separate' => 'https://discord.com/api/webhooks/'
        ],
        'name'         => null, // Will fallback to input string
        'site'         => 'https://davidcarbon.dev',
        'event_json'   => 'Default.json',
        'panel'        => ['url' => 'https://eaglejump.org/', 'type' => 'static'],
        'icon'         => 'Aoba%20Suzukaze.webp',
        'profile_name' => 'Aoba: Anti-Cheat'
    ];

    private static $servers = [
        'worldonline' => [
            'identifiers' => ['worldonline.pl'],
            'webhooks' => [
                'normal'   => 'https://discord.com/api/webhooks/',
                'separate' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'WorldOnline',
            'site'         => 'http://worldonline.pl',
            'event_json'   => 'WOPL.json',
            'panel'        => ['url' => 'http://ap.worldonline.pl/driver/%s', 'type' => 'name'],
            'icon'         => 'Nene%20Sakura.webp',
            'profile_name' => 'Nene: Anti-Cheat'
        ],
        'worldunited' => [
            'identifiers' => ['game.worldunited.gg', '51.161.118.213'],
            'webhooks' => [
                'normal'   => 'https://discord.com/api/webhooks/',
                'separate' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'WorldUnited OFFICIAL',
            'site'         => 'https://worldunited.gg',
            'event_json'   => 'WorldUnitedGG.json',
            'panel'        => ['url' => 'https://panel.worldunited.gg/drivers/%s', 'type' => 'name'],
            'icon'         => 'Christina%20Wako%20Yamato.webp',
            'profile_name' => 'Christina: Anti-Cheat'
        ],
        'worldunited_dev' => [
            'identifiers' => ['209.97.187.156', '144.126.250.247'],
            'webhooks' => [
                'normal'   => 'https://discord.com/api/webhooks/',
                'separate' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'WorldUnited DEVELOPMENT',
            'site'         => 'https://worldunited.gg',
            'event_json'   => 'WorldUnitedGG.json', // Assuming same events as main
            'panel'        => ['url' => 'https://panel.worldunited.gg/drivers/%s', 'type' => 'name'],
            'icon'         => 'Christina%20Wako%20Yamato.webp',
            'profile_name' => 'Christina: Anti-Cheat'
        ],
        'nightriderz_horizon' => [
            'identifiers' => ['horizon.nightriderz.world', '142.132.196.182'],
            'webhooks' => [
                'normal'   => 'https://discord.com/api/webhooks/',
                'separate' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'NIGHTRIDERZ: Horizon',
            'site'         => 'https://nightriderz.world',
            'event_json'   => 'NightRiderz.json',
            'panel'        => ['url' => 'https://nightriderz.world/player/driver/%s', 'type' => 'id'],
            'icon'         => 'Rin%20Toyama.webp',
            'profile_name' => 'Rin: Anti-Cheat'
        ],
        'nightriderz_lab' => [
            'identifiers' => ['thelab.nightriderz.world', '89.234.180.231'],
            'webhooks' => [
                'normal'   => 'https://discord.com/api/webhooks/',
                'separate' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'NIGHTRIDERZ: The lab',
            'site'         => 'https://nightriderz.world',
            'event_json'   => 'NightRiderz.json',
            'panel'        => ['url' => 'https://nightriderz.world', 'type' => 'static'],
            'icon'         => 'Rin%20Toyama.webp',
            'profile_name' => 'Rin: Anti-Cheat'
        ],
        'worldevolved' => [
            'identifiers' => ['92.63.111.195', '45.133.216.224'],
            'webhooks' => [
                'normal'   => 'https://discord.com/api/webhooks/',
                'separate' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'World Evolved RU',
            'site'         => 'http://world-evolved.ru',
            'event_json'   => 'WE.json',
            'panel'        => ['url' => 'http://world-evolved.ru/en/stats/profiles/%s', 'type' => 'name'],
            'icon'         => 'Momiji%20Mochizuki.webp',
            'profile_name' => 'Momiji: Anti-Cheat'
        ],
        'undergroundstage' => [
            'identifiers' => ['155.138.131.23', 'core.undergroundstage.net'],
            'webhooks' => [
                'normal'   => 'https://discord.com/api/webhooks/',
                'separate' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'UNDERGROUND STAGE',
            'site'         => 'http://undergroundstage.net',
            'event_json'   => 'UGS.json',
            'panel'        => ['url' => 'https://nfsranks.undergroundstage.net/drivers/%s', 'type' => 'name'],
            'icon'         => 'Tsubame%20Narumi.webp',
            'profile_name' => 'Tsubame: Anti-Cheat'
        ],
        'sparkserver' => [
            'identifiers' => ['core.sparkserver.io', '138.201.247.232'],
            'webhooks' => [
                'normal'   => 'https://discord.com/api/webhooks/',
                'separate' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'Sparkserver',
            'site'         => 'https://sparkserver.io',
            'event_json'   => 'FRSS.json',
            'panel'        => ['url' => 'https://ranks.sparkserver.io/drivers/%s', 'type' => 'id'],
            'icon'         => 'Yun%20Iijima.webp',
            'profile_name' => 'Yun: Anti-Cheat'
        ],
        'overdrive' => [
            'identifiers' => ['66.11.123.232', 'overdriveworld.com', '40.160.225.21'],
            'webhooks' => [
                'normal'   => 'https://discord.com/api/webhooks/',
                'separate' => 'https://discord.com/api/webhooks/'
            ],
            'name'         => 'OVERDRIVE',
            'site'         => 'https://overdriveworld.com',
            'event_json'   => 'Default.json',
            'panel'        => ['url' => 'https://overdriveworld.com/drivers/%s', 'type' => 'name'],
            'icon'         => 'Shizuku%20Hazuki.webp',
            'profile_name' => 'Shizuku: Anti-Cheat'
        ],
        'davidcarbon_dev' => [
            'identifiers' => [], // Special logic handled in resolve()
            'webhooks' => [
                'normal'   => null, // Uses default
                'separate' => null  // Uses default
            ],
            'name'         => 'Debug Report - Test Processed',
            'site'         => 'https://davidcarbon.dev',
            'event_json'   => 'Default.json',
            'panel'        => ['url' => 'https://eaglejump.org/', 'type' => 'static'],
            'icon'         => 'Umiko%20Ahagon.webp',
            'profile_name' => 'Umiko: Anti-Cheat'
        ]
    ];

    /**
     * Resolves the server config based on the input string (IP or Domain)
     */
    public static function get($string)
    {
        // 1. Direct Lookup
        foreach (self::$servers as $key => $config) {
            if (in_array($string, $config['identifiers'])) {
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
            if ($config['webhooks']['normal'] === null) {
                $finalConfig['webhooks'] = self::$defaultConfig['webhooks'];
            }
            return $finalConfig;
        }

        // 3. Fallback
        return self::$defaultConfig;
    }

    public static function getBaseEventUrl() {
        return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/JSON/Events/';
    }
    
    public static function getBaseIconUrl() {
        return 'https://i.eaglejump.org/team/';
    }
}


/* Sets the correct Discord Channel */
function DiscordChannelHook($string, $separate_channel_UID = false)
{
    $config = ServerRegistry::get($string);
    return $separate_channel_UID ? $config['webhooks']['separate'] : $config['webhooks']['normal'];
}

/* Provides Server Name */
function ServerName($string)
{
    $config = ServerRegistry::get($string);
    return $config['name'] ?? $string; // Return config name or original string if null
}

/* Provides Server Links */
function ServerSiteLink($string)
{
    $config = ServerRegistry::get($string);
    return $config['site'];
}

/* Provides File URL for Events */
function EventListLink($string)
{
    $config = ServerRegistry::get($string);
    return ServerRegistry::getBaseEventUrl() . $config['event_json'];
}

/* Provides Public Profile Links (Panel) */
function PlayerPanel($ServerDNS, $PersonaID, $PersonaName)
{
    $config = ServerRegistry::get($ServerDNS);
    $panel = $config['panel'];

    if ($panel['type'] === 'static') {
        return $panel['url'];
    } elseif ($panel['type'] === 'id') {
        return sprintf($panel['url'], $PersonaID);
    } else {
        // Default to Name
        return sprintf($panel['url'], $PersonaName);
    }
}

/* Sets the correct Discord Channel */
function ProfileIconURL($string)
{
    // Special override found in original code
    if ($string == 'Hifumi Takimoto') {
        return ServerRegistry::getBaseIconUrl() . 'Hifumi%20Takimoto.webp';
    }

    $config = ServerRegistry::get($string);
    return ServerRegistry::getBaseIconUrl() . $config['icon'];
}

/* Sets Name for certain servers */
function ProfileName($string)
{
    $config = ServerRegistry::get($string);
    return $config['profile_name'];
}
?>