<?php

namespace Modules\Products\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use Translatable;

    protected $table = 'products__products';
    public $translatedAttributes = [];
    protected $fillable = [];
}
