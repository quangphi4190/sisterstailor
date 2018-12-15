<?php

namespace Modules\Thongke\Repositories\Cache;

use Modules\Thongke\Repositories\ThongketimeRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheThongketimeDecorator extends BaseCacheDecorator implements ThongketimeRepository
{
    public function __construct(ThongketimeRepository $thongketime)
    {
        parent::__construct();
        $this->entityName = 'thongke.thongketimes';
        $this->repository = $thongketime;
    }
}
