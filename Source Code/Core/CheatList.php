<?php

/**
 * CheatRegistry
 * Handles the decoding of anti-cheat flag values into human-readable strings.
 */
class CheatRegistry
{
    /**
     * List of cheat types mapped to bit positions.
     * Note: The mapping relies on the binary string representation.
     * Index 0 corresponds to the leftmost bit of the formatted string.
     */
    private const CHEAT_TYPES = [
        "Ghosting", 
        "Profile Masker", 
        "Pursuit Bot", 
        "Handling Modifier", 
        "Wallhack", 
        "Tank Mode", 
        "Smooth Walls", 
        "Speedhack", 
        "Fast Powerups", 
        "MultiHack", 
        "*Anti-Cheat Internal Error*"
    ];

    /**
     * Resolves a raw cheat code (int or string) into a readable string.
     * * @param mixed $input The cheat code from the launcher
     * @return string
     */
    public static function resolve($input): string
    {
        // 1. Handle Numeric Codes
        if (is_numeric($input)) {
            $value = (int)$input;

            // Error Code: -1
            if ($value == -1) {
                return "Anti-Cheat Failed to Initialize";
            }

            // Valid Bitmask Range
            if ($value > 0 && $value <= 2047) {
                return self::decodeBitmask($value);
            }
            
            // Numeric but out of known range
            return "Unknown: [{$value}]";
        }

        // 2. Handle Non-Numeric / Empty Inputs
        $safeInput = !empty($input) ? $input : "NULL";
        return "Unknown: [{$safeInput}]";
    }

    /**
     * Decodes the integer bitmask into a comma-separated string of cheat names.
     */
    private static function decodeBitmask(int $value): string
    {
        $detected = [];
        
        // Emulate legacy behavior: 
        // 1. Convert to binary.
        // 2. Pad to a MINIMUM of 10 chars (space padded).
        // 3. Split into characters.
        // This preserves the original logic where values > 1023 (11 bits) 
        // effectively shift the mapping indices.
        $binaryString = sprintf("%10d", decbin($value));
        $bits = str_split($binaryString);

        foreach ($bits as $index => $bit) {
            // Check if bit is '1' and if we have a corresponding name in our list
            if ($bit === '1' && isset(self::CHEAT_TYPES[$index])) {
                $detected[] = self::CHEAT_TYPES[$index];
            }
        }

        return implode(", ", $detected);
    }
}

/* -------------------------------------------------------------------------
 * Legacy Wrapper Function
 * -------------------------------------------------------------------------
 * Maintains backward compatibility with index.php
 */
function CheatType($string)
{
    return CheatRegistry::resolve($string);
}
?>