<?php

namespace Core\Database\User\EntityRule;

use Core\Database\Database;
use Core\Interfaces\Database\EntityRuleInterface;
use Exception;

class UserEntityRule implements EntityRuleInterface
{
    public static function insert($entity)
    {
        $db = Database::getInstance();
        if ($entity->getId()) {
            throw new Exception('Irregular use of method insert');
        }
        $entity
            ->setCreatedAt(date('Y-m-d H:i:s'))
            ->save($db);
    }
    public static function update($entity)
    {
        $db = Database::getInstance();
        if (!$entity->getId()) {
            throw new Exception('Irregular use of method update');
        }
        $entity
            ->setUpdatedAt(date('Y-m-d H:i:s'))
            ->save($db);
    }
    public static function delete($entity)
    {
        $db = Database::getInstance();
        if (!$entity->getId()) {
            throw new Exception('Irregular use of method delete');
        }
        $entity->delete($db);
    }
    public static function destroy($entity)
    {
        $db = Database::getInstance();
        if (!$entity->getId()) {
            throw new Exception('Irregular use of method delete');
        }
        $entity->destroy($db);
    }
}
