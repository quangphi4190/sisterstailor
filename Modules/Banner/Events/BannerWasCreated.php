<?php

namespace Modules\Banner\Events;

use Modules\Banner\Entities\Banner;
use Modules\Media\Contracts\StoringMedia;

class BannerWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Product
     */
    public $banner;

    public function __construct(Banner $banner, array $data)
    {
        $this->data = $data;
        $this->banner = $banner;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->banner;
    }

    /**
     * Return the ALL data sent
     * @return array
     */
    public function getSubmissionData()
    {
        return $this->data;
    }
}
