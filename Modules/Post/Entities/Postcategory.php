<?php

namespace Modules\Post\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Postcategory extends Model
{
    use Translatable;

    protected $table = 'post__postcategories';
    public $translatedAttributes = [];
    protected $fillable = [
        'name',
        'slug',
        'status'
    ];
}
