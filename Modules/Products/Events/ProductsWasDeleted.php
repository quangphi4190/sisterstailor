<?php

namespace Modules\Products\Events;

use Modules\Media\Contracts\DeletingMedia;

class ProductsWasDeleted implements DeletingMedia
{
    /**
     * @var string
     */
    private $products;
    /**
     * @var int
     */
    private $productsId;

    public function __construct($productsId, $products)
    {
        $this->products = $products;
        $this->productsId = $productsId;
    }

    /**
     * Get the entity ID
     * @return int
     */
    public function getEntityId()
    {
        return $this->productsId;
    }

    /**
     * Get the class name the imageables
     * @return string
     */
    public function getClassName()
    {
        return $this->products;
    }
}
