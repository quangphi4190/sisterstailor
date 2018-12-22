<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'products__products_translations';
}
