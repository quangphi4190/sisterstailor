<?php

namespace Modules\Thongke\Repositories\Cache;

use Modules\Thongke\Repositories\ThongketourguideRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheThongketourguideDecorator extends BaseCacheDecorator implements ThongketourguideRepository
{
    public function __construct(ThongketourguideRepository $thongketourguide)
    {
        parent::__construct();
        $this->entityName = 'thongke.thongketourguides';
        $this->repository = $thongketourguide;
    }
}
