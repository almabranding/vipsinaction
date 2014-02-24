<?php

class Cache
{
    
    public static function set($myArray)
    {
        //file_put_contents("cache_file", serialize($myArray));
    }
    
    public static function get()
    {
        if(is_file("cache_file"))
        $myArray = unserialize(file_get_contents("cache_file"));
        return $myArray;
    }
    
}