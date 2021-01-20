<?php

namespace Core\Interfaces\Database;

interface EntityInterface
{

    public function setId($id);

    public function getId();

    public function toArray(bool $isInsert = false): array;
}
