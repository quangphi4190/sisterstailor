<?php

namespace Modules\Advertisements\Events;

use Modules\Advertisements\Entities\Advertisement;
use Modules\Media\Contracts\StoringMedia;

class AdvertisementsWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Product
     */
    public $advertisements;

    public function __construct(Advertisement $advertisements, array $data)
    {
        $this->data = $data;
        $this->advertisements = $advertisements;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->advertisements;
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
