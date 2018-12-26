<?php

namespace Modules\Advertisements\Events;

use Modules\Media\Contracts\DeletingMedia;

class AdvertisementsWasDeleted implements DeletingMedia
{
    /**
     * @var string
     */
    private $advertisements;
    /**
     * @var int
     */
    private $id;

    public function __construct($id, $advertisements)
    {
        $this->advertisements = $advertisements;
        $this->id = $id;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->id;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->advertisements;
    }
}
