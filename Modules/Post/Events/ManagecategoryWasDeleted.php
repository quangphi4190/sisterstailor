<?php

namespace Modules\Post\Events;

use Modules\Media\Contracts\DeletingMedia;

class ManagecategoryWasDeleted implements DeletingMedia
{
    /**
     * @var string
     */
    private $managecategorys;
    /**
     * @var int
     */
    private $categoryId;

    public function __construct($categoryId, $managecategorys)
    {
        $this->managecategorys = $managecategorys;
        $this->categoryId = $categoryId;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->categoryId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->managecategorys;
    }
}
