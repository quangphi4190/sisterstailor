<?php

namespace Modules\Banner\Events;

use Modules\Media\Contracts\DeletingMedia;

class BannerWasDeleted implements DeletingMedia
{
    /**
     * @var string
     */
    private $banner;
    /**
     * @var int
     */
    private $id;

    public function __construct($bannerId, $banner)
    {
        $this->banner = $banner;
        $this->id = $bannerId;
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
        return $this->banner;
    }
}
