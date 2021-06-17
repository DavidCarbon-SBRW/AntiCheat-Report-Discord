<?php
function GetEventNameFromFile(int $EventID, String $FileName) 
{
	try
	{
		$events_json = json_decode(file_get_contents($FileName), true);
		
		foreach($events_json as $var) 
		{
			if($var['id'] == $EventID) 
			{
				return '['.$EventID.'] '.$var['trackname'];
			}
		}
		
		return '['.$EventID.'] Unknown';
	}
    catch (Exception $e)
	{
		return '['.$EventID.'] Unknown (JSON Error)';
	}
}

function GetEventImageFromFile(int $EventID, String $FileName) 
{
	try
	{
		$events_json = json_decode(file_get_contents($FileName), true);
    
		foreach($events_json as $var) 
		{
			if($var['id'] == $EventID) 
			{
				return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/IMG/'.$var['type'].'.png';
			}
		}
		
		return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/IMG/gamemode_unknown.png';
	}
	catch (Exception $e)
	{
		return 'https://davidcarbon-sbrw.github.io/AntiCheat-Report-Discord/IMG/gamemode_unknown.png';
	}
}
?>