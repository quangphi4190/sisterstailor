<?php

namespace Modules\Tourguide\Repositories\Cache;

use Modules\Tourguide\Repositories\TourGuideRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheTourGuideDecorator extends BaseCacheDecorator implements TourGuideRepository
{
    public function __construct(TourGuideRepository $tourguide)
    {
        parent::__construct();
        $this->entityName = 'tourguide.tourguides';
        $this->repository = $tourguide;
    }
}
