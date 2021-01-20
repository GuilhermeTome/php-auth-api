<?php

namespace Core\Database\User\Repository;

use Core\Database\Database;
use Core\Database\User\Entity\UserEntity;
use Core\Interfaces\Database\RepositoryInterface;
use PDO;

class UserRepository implements RepositoryInterface
{
    /**
     * @param integer|null $id
     * @return UserEntity
     */
    public static function byId(?int $id = null): UserEntity
    {
        $db = Database::getInstance();
        $row = $db->query('select * from ' . UserEntity::TABLE_NAME . ' where id = :id limit 1', ['id' => $id])->fetchObject(UserEntity::class);
        if ($row === false) {
            return new UserEntity;
        }
        return $row;
    }

    /**
     * @param string $email
     * @return UserEntity
     */
    public static function byEmail(string $email): UserEntity
    {
        $db = Database::getInstance();
        $row = $db->query('select * from ' . UserEntity::TABLE_NAME . ' where email = :email limit 1', ['email' => $email])->fetchObject(UserEntity::class);
        if ($row === false) {
            return new UserEntity;
        }
        return $row;
    }

    /**
     * @param integer $id
     * @param string $token
     * @return UserEntity
     */
    public static function byIdAndToken(int $id, string $token): UserEntity
    {
        $db = Database::getInstance();
        $row = $db->query('select * from ' . UserEntity::TABLE_NAME . ' where id = :id and token = :token limit 1', ['id' => $id, 'token' => $token])->fetchObject(UserEntity::class);
        if ($row === false) {
            return new UserEntity;
        }
        return $row;
    }

    /**
     * @param string $token
     * @return UserEntity
     */
    public static function byToken(string $token): UserEntity
    {
        $db = Database::getInstance();
        $row = $db->query('select * from ' . UserEntity::TABLE_NAME . ' where token = :token limit 1', ['token' => $token])->fetchObject(UserEntity::class);
        if ($row === false) {
            return new UserEntity;
        }
        return $row;
    }

    /**
     * @param array|null $options
     * @return array
     */
    public static function all(?array $options = null): array
    {
        $db = Database::getInstance();
        return $db->query('select * from ' . UserEntity::TABLE_NAME . ' where deleted_at is null')->fetchAll(PDO::FETCH_CLASS, UserEntity::class);
    }
}
