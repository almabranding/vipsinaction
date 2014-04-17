<?php

class Session
{
    
    public static function init()
    {
        @session_name("mycausa"); 
        @session_start();
    }
    
    public static function set($key, $value)
    {
        $_SESSION['intranet'][$key] = $value;
    }
    
    public static function get($key)
    {
        if (isset($_SESSION['intranet'][$key]))
        return $_SESSION['intranet'][$key];
    }
    
    public static function destroy()
    {
        //unset($_SESSION);
        session_destroy();
    }
    
}