<?php

namespace Core\Tools;

class Session
{
    /**
     * @param string $key
     * @param boolean $delete
     * @return array
     */
    public static function get(string $key, bool $delete = false):array
    {
        $s = [];

        if(isset($_SESSION[$key])) {
            $s = $_SESSION[$key]?:[];

            if($delete) {
                unset($_SESSION[$key]);
            }
        }

        return $s;
    }

    /**
     * @param string $key
     * @param array $values
     * @return void
     */
    public static function save(string $key, array $values):void
    {
        $_SESSION[$key] = $values;
    }

    /**
     * @param string $key
     * @return void
     */
    public static function drop(string $key):void
    {
        unset($_SESSION[$key]);
    }

    /**
     * @param string $key
     * @return boolean
     */
    public static function has(string $key):bool
    {
        return isset($_SESSION[$key]) && !empty($_SESSION[$key]);
    }
}
