<?php

namespace Modules\Advertisements\Repositories\Cache;

use Modules\Advertisements\Repositories\AdvertisementRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheAdvertisementDecorator extends BaseCacheDecorator implements AdvertisementRepository
{
    public function __construct(AdvertisementRepository $advertisement)
    {
        parent::__construct();
        $this->entityName = 'advertisements.advertisements';
        $this->repository = $advertisement;
    }
}
