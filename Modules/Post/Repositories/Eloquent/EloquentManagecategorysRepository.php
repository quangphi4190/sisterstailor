<?php

namespace Modules\Post\Repositories\Eloquent;

use Modules\Post\Events\ManagecategoryWasCreated;
use Modules\Post\Events\ManagecategoryWasDeleted;
use Modules\Post\Events\ManagecategoryWasUpdated;
use Modules\Post\Repositories\ManagecategorysRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentManagecategorysRepository extends EloquentBaseRepository implements ManagecategorysRepository
{
    public function create($data)
    {
        $managecategorys = $this->model->create($data);

        event(new ManagecategoryWasCreated($managecategorys, $data));

        return $managecategorys;
    }

    /**
     * Update a resource
     * @param $managecategorys
     * @param  array $data
     * @return mixed
     */
    
    public function update($managecategorys, $data)
    {
        $managecategorys->update($data);

        event(new ManagecategoryWasUpdated($managecategorys, $data));

        return $managecategorys;
    }
    public function destroy($model)
    {
        event(new ManagecategoryWasDeleted($model, get_class($model)));

        return $model->delete();
    }
}
