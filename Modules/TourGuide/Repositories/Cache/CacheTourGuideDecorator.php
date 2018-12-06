<?php

namespace Modules\TourGuide\Repositories\Cache;

use Modules\TourGuide\Repositories\TourGuideRepository;
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
