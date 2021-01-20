<?php

namespace Modules\App\Auth\Models;

use Core\Database\User\Entity\UserEntity;
use Core\Database\User\EntityRule\UserEntityRule;
use Core\Database\User\Repository\UserRepository;
use Core\Tools\Form;
use Core\Tools\Hash;
use Core\Tools\Jwt;
use Exception;
use stdClass;

class AuthModel
{
    /**
     * @return stdClass
     */
    public static function refresh(): stdClass
    {
        $res = new stdClass;
        $res->status = true;
        $res->token = '';
        $res->data = [
            'name' => '',
            'email' => '',
            'avatar' => ''
        ];

        try {
            $token = Jwt::decode(Form::get('token'));

            $user = UserRepository::byIdAndToken((int)base64_decode($token['slug']), (string)$token['token']);
            if (!is_null($user->getId())) {

                $res->jwt = Jwt::encode([
                    'slug' => base64_encode($user->getId()),
                    'token' => $user->getToken(),
                    'generated_at' => time()
                ]);
                $res->data = [
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'avatar' => $user->getAvatar(true)
                ];
            } else {
                $res->status = false;
            }
        } catch (\Throwable $th) {
            throw new Exception('Token inválido', 2);
        }
        return $res;
    }

    /**
     * @return stdClass
     */
    public static function signIn(): stdClass
    {
        $res = new stdClass;
        $res->msg = '';
        $res->token = '';

        $email = Form::get('email', 'Email', [Form::REQUIRED, Form::EMAIL]);
        $password = Form::get('password', 'Password', [Form::REQUIRED]);

        $user = UserRepository::byEmail($email);
        if (is_null($user->getId())) {
            throw new Exception("E-mail e/ou senha incorretos", 1);
        }

        if (!Hash::verify($password, $user->getPassword())) {
            throw new Exception("E-mail e/ou senha incorretos", 1);
        }

        $user->setToken(md5(uniqid(UNIQID_HASH)));
        UserEntityRule::update($user);

        $res->jwt = Jwt::encode([
            'slug' => base64_encode($user->getId()),
            'token' => $user->getToken(),
            'generated_at' => time()
        ]);

        $res->user = $user;
        return $res;
    }

    /**
     * @return stdClass
     */
    public static function signUp(): stdClass
    {
        $res = new stdClass;
        $res->msg = '';
        $res->token = '';

        $name = Form::get('name', 'Name', [Form::REQUIRED]);
        $email = Form::get('email', 'Email', [Form::REQUIRED, Form::EMAIL]);
        $password = Form::get('password', 'Password', [Form::REQUIRED]);

        if (!is_null((UserRepository::byEmail($email))->getId())) {
            throw new Exception("Esse e-mail já está cadastrado", 1);
        }

        $user = (new UserEntity)
            ->setName($name)
            ->setEmail($email)
            ->setPassword($password, true)
            ->setToken(md5(uniqid(UNIQID_HASH)));

        UserEntityRule::insert($user);

        $res->jwt = Jwt::encode([
            'slug' => base64_encode($user->getId()),
            'token' => $user->getToken(),
            'generated_at' => time()
        ]);

        $res->user = $user;
        return $res;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public static function signOut(): void
    {
        try {
            $token = Jwt::decode(Form::get('token'));

            $user = UserRepository::byIdAndToken((int)base64_decode($token['slug']), (string)$token['token']);
            if (!is_null($user->getId())) {
                $user->setToken('');
                UserEntityRule::update($user);

                return;
            }
            throw new Exception('Token inválido', 2);
        } catch (\Throwable $th) {
            throw new Exception('Token inválido', 2);
        }
    }
}
