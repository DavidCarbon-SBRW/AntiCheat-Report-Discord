<?php
function IsHWIDNull($string) {
    if (!empty($string)) {
        return $string;
    }
    else {
        return 'No HWID Provided';
    }
}
?>