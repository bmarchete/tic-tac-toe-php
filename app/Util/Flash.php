<?php
namespace Project\Util;

class Flash
{
    public static function getFlash()
    {
        if( array_key_exists('flash', $_SESSION)){
           $flash = $_SESSION['flash'];
           unset($_SESSION['flash']);
           return $flash;
           
       }

       return false;
    }

    public static function setFlash($flash)
    {
        $_SESSION['flash'] = $flash;
    }
}