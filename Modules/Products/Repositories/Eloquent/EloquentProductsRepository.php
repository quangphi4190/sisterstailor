<?php

namespace Modules\Products\Repositories\Eloquent;

use Modules\Products\Events\ProductsWasCreated;
use Modules\Products\Events\ProductsWasDeleted;
use Modules\Products\Events\ProductsWasUpdated;
use Modules\Products\Repositories\ProductsRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentProductsRepository extends EloquentBaseRepository implements ProductsRepository
{
    public function create($data)
    {
        $products = $this->model->create($data);

        event(new ProductsWasCreated($products, $data));
        return $products;
    }

    /**
     * Update a resource
     * @param $dining
     * @param  array $data
     * @return mixed
     */
    public function update($products, $data)
    {
        $products->update($data);

        event(new ProductsWasUpdated($products, $data));

        return $products;
    }

    public function destroy($model)
    {
        event(new ProductsWasDeleted($model->id, get_class($model)));

        return $model->delete();
    }

}
