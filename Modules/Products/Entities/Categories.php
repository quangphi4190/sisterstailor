<?php

namespace Modules\Products\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use Translatable;

    protected $table = 'products__categories';
    public $translatedAttributes = [];
    protected $fillable = [];
}
