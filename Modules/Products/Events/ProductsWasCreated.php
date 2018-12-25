<?php

namespace Modules\Products\Events;

use Modules\Products\Entities\Products;
use Modules\Media\Contracts\StoringMedia;

class ProductsWasCreated implements StoringMedia
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Product
     */
    public $products;

    public function __construct(Products $products, array $data)
    {
        $this->data = $data;
        $this->products = $products;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->products;
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
