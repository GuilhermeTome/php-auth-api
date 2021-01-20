<?php

namespace Core\Database\User\Entity;

use Core\Database\DatabaseEntity;
use Core\Tools\Hash;
use Core\Traits\Timestamps;

class UserEntity extends DatabaseEntity
{
    private $array;
    const TABLE_NAME = 'users';

    private $id;
    private $name;
    private $email;
    private $avatar;
    private $token;
    private $password;

    use Timestamps;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password, bool $hash = false)
    {
        if ($hash) {
            $this->password = Hash::make($password);

            return $this;
        }

        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of avatar
     */
    public function getAvatar(bool $url = false)
    {
        if ($url) {
            if (is_file(PATH_PUBLIC . 'assets' . DS . 'avatar' . DS . $this->avatar)) {
                return asset('avatar/' . $this->avatar);
            }
            return asset('avatar/default.png');
        }

        return $this->avatar;
    }

    /**
     * Set the value of avatar
     *
     * @return  self
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @param boolean $isInsert
     * @param boolean $isApi
     * @return array
     */
    public function toArray(bool $isInsert = false, bool $isApi = false): array
    {
        $this->array = [
            'id' => $this->getId($isApi),
            'name' => $this->getName($isApi),
            'email' => $this->getEmail($isApi),
            'token' => $this->getToken($isApi),
            'password' => $this->getPassword($isApi),
            'avatar' => $this->getAvatar($isApi),
            'created_at' => $this->getCreatedAt($isApi),
            'updated_at' => $this->getUpdatedAt($isApi),
            'deleted_at' => $this->getDeletedAt($isApi)
        ];

        if ($isInsert) {
            unset($this->array['id']);
        }

        if ($isApi) {
            unset($this->array['deleted_at']);
            unset($this->array['password']);
        }

        return $this->array;
    }
}
