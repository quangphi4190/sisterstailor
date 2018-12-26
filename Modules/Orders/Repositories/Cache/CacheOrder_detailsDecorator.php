<?php

namespace Modules\Orders\Repositories\Cache;

use Modules\Orders\Repositories\Order_detailsRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheOrder_detailsDecorator extends BaseCacheDecorator implements Order_detailsRepository
{
    public function __construct(Order_detailsRepository $order_details)
    {
        parent::__construct();
        $this->entityName = 'orders.order_details';
        $this->repository = $order_details;
    }
}
