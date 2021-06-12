<?php
function CheckProvidedValue($string, $value) {
    if (!empty($value)) {
        if($string == "User-ID") {
            return $value;
        }
        else {
            return "||".$value."||";
        }
    }
    else {
        return 'No '.$string.' Provided';
    }
}
?>