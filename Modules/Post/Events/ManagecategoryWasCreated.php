<?php

namespace Modules\Post\Events;

use Modules\Post\Entities\Managecategorys;
use Modules\Media\Contracts\StoringMedia;

class ManagecategoryWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Product
     */
    public $managecategorys;

    public function __construct(Managecategorys $managecategorys, array $data)
    {
        $this->data = $data;
        $this->managecategorys = $managecategorys;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->managecategorys;
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
