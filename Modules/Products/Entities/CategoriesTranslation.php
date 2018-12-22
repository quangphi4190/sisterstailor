<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoriesTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'products__categories_translations';
}
