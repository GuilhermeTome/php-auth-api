<?php

namespace Core\Interfaces\Database;

interface EntityRuleInterface
{
    public static function insert($entity);

    public static function update($entity);

    public static function destroy($entity);
}
