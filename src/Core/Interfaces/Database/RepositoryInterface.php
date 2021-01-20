<?php

namespace Core\Interfaces\Database;

interface RepositoryInterface
{
    public static function byId(?int $id = null): Object;

    public static function all(array $options = null): array;
}
