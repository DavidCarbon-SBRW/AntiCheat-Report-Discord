<?php
function GetEventNameFromFile(int $EventID, String $FileName) {
    $events_json = json_decode(file_get_contents($FileName), true);
    
    foreach($events_json as $var) {
        if($var['id'] == $EventID) {
            return '['.$EventID.'] '.$var['trackname'];
        }
    }
    return '['.$EventID.'] Unknown';
}

function GetEventImageFromFile(int $EventID, String $FileName) {
    $events_json = json_decode(file_get_contents($FileName), true);
    
    foreach($events_json as $var) {
        if($var['id'] == $EventID) {
            return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/IMG/'.$var['type'].'.png';
        }
    }
    return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/IMG/gamemode_unknown.png';
}
?>