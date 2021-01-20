<?php

namespace Core\Database;

use Core\Interfaces\Database\EntityInterface;
use Medoo\Medoo;

abstract class DatabaseEntity implements EntityInterface
{
    public function save(Medoo $db)
    {
        if (!$this->getId()) {
            $db->insert($this::TABLE_NAME, $this->toArray(true));
            $id = $db->id();
            $this->setId($id);
            return;
        }
        $db->update($this::TABLE_NAME, $this->toArray(), ['id' => $this->getId()]);
    }

    public function saveWhere(Medoo $db, array $where = [])
    {
        $db->update($this::TABLE_NAME, $this->toArray(), $where);
    }

    public function delete(Medoo $db)
    {
        if (!$this->getId()) {
            return;
        }

        if (in_array('Core\Traits\Timestamps', get_declared_traits())) {
            $db->update($this::TABLE_NAME, ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $this->getId()]);
            return;
        }

        $db->delete($this::TABLE_NAME, ['id' => $this->getId()]);
    }

    public function destroy(Medoo $db)
    {
        if (!$this->getId()) {
            return;
        }
        $db->delete($this::TABLE_NAME, ['id' => $this->getId()]);
    }

    public function fromJson(array $json)
    {
        foreach ($json as $campo => $valor) {
            $c = $campo;
            $this->$c = $valor;
        }
    }
}
