<?php
function GetEventNameFromFile(int $EventID, String $FileName) {
    $events_json = json_decode(file_get_contents($FileName), true);
    
    if ($events_json === TRUE) {
        try {
            foreach($events_json as $var) {
                if($var['id'] == $EventID) {
                    return '('$EventID.') '.$var['trackname'];
                }
            }
            return '('.$EventID.') Unknown';
        }
        catch (Exception $e) {
            return '('.$EventID.') JSON Error';
        }
    }
    else
    {
      return '('.$EventID.') Unknown';
    }
}

function GetEventImageFromFile(int $EventID, String $FileName) {
    $events_json = json_decode(file_get_contents($FileName), true);
    
    if ($events_json === TRUE) {
        try {
            foreach($events_json as $var) {
                if($var['id'] == $EventID) {
                    return $var['type'];
                }
            }
            return 'gamemode_unknown';
        }
        catch (Exception $e) {
            return 'gamemode_unknown';
        }
    }
    else
    {
      return 'gamemode_unknown';
    }
}
?>