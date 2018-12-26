<?php

namespace Modules\Banner\Repositories\Eloquent;

use Modules\Banner\Events\BannerWasCreated;
use Modules\Banner\Events\BannerWasDeleted;
use Modules\Banner\Events\BannerWasUpdated;
use Modules\Banner\Repositories\BannerRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentBannerRepository extends EloquentBaseRepository implements BannerRepository
{
	public function create($data)
    {
        $banners = $this->model->create($data);

        event(new BannerWasCreated($banners, $data));

        return $banners;
    }

    /**
     * Update a resource
     * @param $banners
     * @param  array $data
     * @return mixed
     */
    
    public function update($banners, $data)
    {
        $banners->update($data);

        event(new BannerWasUpdated($banners, $data));

        return $banners;
    }
    public function destroy($model)
    {
        event(new BannerWasDeleted($model, get_class($model)));

        return $model->delete();
    }
}
