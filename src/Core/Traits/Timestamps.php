<?php

namespace Core\Traits;

trait Timestamps
{
    private $created_at;
    private $updated_at;
    private $deleted_at;

    /**
     * Get the value of created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get the value of deleted_at
     */
    public function getDeletedAt()
    {
        return $this->deleted_at;
    }

    /**
     * Set the value of deleted_at
     *
     * @return  self
     */
    public function setDeletedAt($deleted_at)
    {
        $this->deleted_at = $deleted_at;

        return $this;
    }
}
