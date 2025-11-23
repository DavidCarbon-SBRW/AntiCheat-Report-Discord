<?php

/**
 * EventRegistry
 * Handles the retrieval and caching of event data from external JSON sources.
 */
class EventRegistry
{
    // Cache loaded JSON data to prevent multiple file reads/network requests
    private static $jsonCache = [];
    
    // Centralized configuration for image assets
    private const IMAGE_BASE_URL = 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/IMG/';
    private const DEFAULT_IMAGE = 'gamemode_unknown.png';

    /**
     * Retrieves the event name by ID from the specified JSON source.
     * * @param int $eventId
     * @param string $source File path or URL to the JSON file
     * @return string Formatted event name
     */
    public static function getName(int $eventId, string $source): string
    {
        $data = self::loadData($source);
        
        foreach ($data as $event) {
            if (isset($event['id']) && $event['id'] == $eventId) {
                $trackName = $event['trackname'] ?? 'Unknown';
                return "[{$eventId}] {$trackName}";
            }
        }

        return "[{$eventId}] Unknown";
    }

    /**
     * Retrieves the event image URL by ID from the specified JSON source.
     * * @param int $eventId
     * @param string $source File path or URL to the JSON file
     * @return string URL to the event image
     */
    public static function getImage(int $eventId, string $source): string
    {
        $data = self::loadData($source);

        foreach ($data as $event) {
            if (isset($event['id']) && $event['id'] == $eventId) {
                $type = $event['type'] ?? 'gamemode_unknown';
                return self::IMAGE_BASE_URL . $type . '.png';
            }
        }

        return self::IMAGE_BASE_URL . self::DEFAULT_IMAGE;
    }

    /**
     * Loads and caches JSON data from the source.
     * Handles exceptions gracefully to ensure the application doesn't crash on a missing file.
     * * @param string $source
     * @return array
     */
    private static function loadData(string $source): array
    {
        // Return cached data if available
        if (isset(self::$jsonCache[$source])) {
            return self::$jsonCache[$source];
        }

        try {
            // Use @ to suppress PHP warnings for file fetch failures, handling them in the check below
            $content = @file_get_contents($source);
            
            if ($content === false) {
                // You might want to log this error in a real production environment
                throw new Exception("Unable to fetch content from source.");
            }
            
            $json = json_decode($content, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("JSON Decode Error: " . json_last_error_msg());
            }

            self::$jsonCache[$source] = $json;

        } catch (Exception $e) {
            // On error, cache an empty array to prevent retrying the failed source and return safe defaults
            self::$jsonCache[$source] = [];
        }

        return self::$jsonCache[$source];
    }
}

/* * -------------------------------------------------------------------------
 * Legacy Wrapper Functions 
 * -------------------------------------------------------------------------
 * These functions ensure backward compatibility with index.php and other 
 * files that call these global functions directly.
 */

function GetEventNameFromFile(int $EventID, string $FileName) 
{
    return EventRegistry::getName($EventID, $FileName);
}

function GetEventImageFromFile(int $EventID, string $FileName) 
{
    return EventRegistry::getImage($EventID, $FileName);
}
?>