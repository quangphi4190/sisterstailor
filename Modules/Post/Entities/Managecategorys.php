<?php

namespace Modules\Post\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Managecategorys extends Model
{
    use Translatable;

    protected $table = 'post__managecategorys';
    public $translatedAttributes = [];
    protected $fillable = [];
}
