<?php

namespace Core\Tools;

class Hash
{
    /**
     * @param string $pass
     * @return string
     */
    public static function make(string $pass): string
    {
        return password_hash($pass, PASSWORD_DEFAULT);
    }

    /**
     * @param string $pass
     * @param string $hash
     * @return boolean
     */
    public static function verify(string $pass, string $hash): bool
    {
        return password_verify($pass, $hash);
    }
}
