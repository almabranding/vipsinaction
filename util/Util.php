<?php

/**
 * 
 */
class Util {
    public static function getDate($date) {
        if(LANG=='CH' || LANG=='JP')return $string;
        $string = strip_tags($string);
        $_limit=74;
        if (strlen($string) > $_limit) {
            // truncate string
            $stringCut = substr($string, 0, $_limit);

            // make sure it ends in a word so assassinate doesn't become ass...
            if($stringCut) $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...';
        }
        return $string;
    }

}