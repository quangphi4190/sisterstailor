<?php

namespace Modules\Post\Repositories\Cache;

use Modules\Post\Repositories\ManagecategorysRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheManagecategorysDecorator extends BaseCacheDecorator implements ManagecategorysRepository
{
    public function __construct(ManagecategorysRepository $managecategorys)
    {
        parent::__construct();
        $this->entityName = 'post.managecategorys';
        $this->repository = $managecategorys;
    }
}
