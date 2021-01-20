<?php

namespace Core\Tools;

use Exception;

class Form
{
    const REQUIRED = 'required';
    const EMAIL = 'email';
    const NUMBER = 'number';

    private static $input = null;

    /**
     * @param string $key
     * @param string $name
     * @param array $validations
     * @return integer|string
     */
    public static function get(string $key, string $name = '', array $validations = [])
    {
        if (is_null(self::$input)) {
            self::$input = json_decode(file_get_contents('php://input'), true);
            if (self::$input == []) {
                self::$input = $_POST;
            }
        }

        $value = '';
        if (isset(self::$input[$key])) {
            $value = self::$input[$key];
        }
        $value = htmlspecialchars(stripslashes(trim($value)));


        if ($validations != []) {
            return self::validate($value, $name, $validations);
        }

        return $value;
    }

    /**
     * @param integer|string $value
     * @param string $name
     * @param array $validations
     * @return integer|string $value
     */
    private static function validate($value, string $name, array $validations)
    {
        if (in_array(self::REQUIRED, $validations)) {
            self::validateRequired($value, $name);
        }

        if (in_array(self::EMAIL, $validations)) {
            self::validateEmail($value, $name);
        }

        if (in_array(self::NUMBER, $validations)) {
            self::validateNumber($value, $name);
        }

        return $value;
    }

    /**
     * @param integer|string $value
     * @param string $name
     * @return void
     */
    private static function validateRequired($value, string $name)
    {
        if ($value === '') {
            throw new Exception("O campo {$name} é obrigatório!");
        }
    }

    /**
     * @param integer|string $value
     * @param string $name
     * @return void
     */
    private static function validateEmail($value, string $name)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("O campo {$name} deve ser um e-mail válido!");
        }
    }

    /**
     * @param integer|string $value
     * @param string $name
     * @return void
     */
    private static function validateNumber($value, string $name)
    {
        if (!is_numeric($value)) {
            throw new Exception("O campo {$name} deve ser um número válido!");
        }
    }
}
