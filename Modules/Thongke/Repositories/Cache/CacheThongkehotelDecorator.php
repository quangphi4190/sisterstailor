<?php

namespace Modules\Thongke\Repositories\Cache;

use Modules\Thongke\Repositories\ThongkehotelRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheThongkehotelDecorator extends BaseCacheDecorator implements ThongkehotelRepository
{
    public function __construct(ThongkehotelRepository $thongkehotel)
    {
        parent::__construct();
        $this->entityName = 'thongke.thongkehotels';
        $this->repository = $thongkehotel;
    }
}
