<?php

namespace Modules\Post\Repositories\Cache;

use Modules\Post\Repositories\PostcategoryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePostcategoryDecorator extends BaseCacheDecorator implements PostcategoryRepository
{
    public function __construct(PostcategoryRepository $postcategory)
    {
        parent::__construct();
        $this->entityName = 'post.postcategories';
        $this->repository = $postcategory;
    }
}
