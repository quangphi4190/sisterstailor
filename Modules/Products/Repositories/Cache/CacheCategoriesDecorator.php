<?php

namespace Modules\Products\Repositories\Cache;

use Modules\Products\Repositories\CategoriesRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCategoriesDecorator extends BaseCacheDecorator implements CategoriesRepository
{
    public function __construct(CategoriesRepository $categories)
    {
        parent::__construct();
        $this->entityName = 'products.categories';
        $this->repository = $categories;
    }
}
