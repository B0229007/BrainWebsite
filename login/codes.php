<?php
function num2text($num) {
    $text = "";

    for ($i = 0; $i < strlen($num) - 1; $i++) {
        $shift = substr($num, $i, 1);
        $char = substr($num, $i + 1, 1);
        $key = $char + $shift;

        switch ($key) {
            case '0': $text .= "a"; break;
            case '1': $text .= "B"; break;
            case '2': $text .= "3"; break;
            case '3': $text .= "D"; break;
            case '4': $text .= "E"; break;
            case '5': $text .= "F"; break;
            case '6': $text .= "G"; break;
            case '7': $text .= "H"; break;
            case '8': $text .= "i"; break;
            case '9': $text .= "J"; break;
            case '10': $text .= "K"; break;
            case '11': $text .= "Z"; break;
            case '12': $text .= "7"; break;
            case '13': $text .= "N"; break;
            case '14': $text .= "4"; break;
            case '15': $text .= "5"; break;
            case '16': $text .= "Q"; break;
            case '17': $text .= "R"; break;
            case '18': $text .= "8"; break;
            case '19': $text .= "T"; break;
         }
        }
    	return $text;
}
?>
