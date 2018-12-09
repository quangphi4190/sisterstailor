<?php

namespace Modules\Customers\Repositories\Cache;

use Modules\Customers\Repositories\CustomerRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCustomerDecorator extends BaseCacheDecorator implements CustomerRepository
{
    public function __construct(CustomerRepository $customer)
    {
        parent::__construct();
        $this->entityName = 'customers.customers';
        $this->repository = $customer;
    }
}
