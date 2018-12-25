<?php

namespace Modules\Advertisements\Repositories\Eloquent;

use Modules\Advertisements\Events\AdvertisementsWasCreated;
use Modules\Advertisements\Events\AdvertisementsWasDeleted;
use Modules\Advertisements\Events\AdvertisementsWasUpdated;
use Modules\Advertisements\Repositories\AdvertisementRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentAdvertisementRepository extends EloquentBaseRepository implements AdvertisementRepository
{
    public function create($data)
    {
        $advertisements = $this->model->create($data);

        event(new AdvertisementsWasCreated($advertisements, $data));

        return $advertisements;
    }

    /**
     * Update a resource
     * @param $advertisements
     * @param  array $data
     * @return mixed
     */
    
    public function update($advertisements, $data)
    {
        $advertisements->update($data);

        event(new AdvertisementsWasUpdated($advertisements, $data));

        return $advertisements;
    }
    public function destroy($model)
    {
        event(new AdvertisementsWasDeleted($model, get_class($model)));

        return $model->delete();
    }
}
