<?php

namespace Modules\Thongke\Repositories\Cache;

use Modules\Thongke\Repositories\ThongkedayRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheThongkedayDecorator extends BaseCacheDecorator implements ThongkedayRepository
{
    public function __construct(ThongkedayRepository $thongkeday)
    {
        parent::__construct();
        $this->entityName = 'thongke.thongkedays';
        $this->repository = $thongkeday;
    }
}
