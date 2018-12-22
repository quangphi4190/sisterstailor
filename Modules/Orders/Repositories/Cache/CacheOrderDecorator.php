<?php

namespace Modules\Orders\Repositories\Cache;

use Modules\Orders\Repositories\OrderRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheOrderDecorator extends BaseCacheDecorator implements OrderRepository
{
    public function __construct(OrderRepository $order)
    {
        parent::__construct();
        $this->entityName = 'orders.orders';
        $this->repository = $order;
    }
}
