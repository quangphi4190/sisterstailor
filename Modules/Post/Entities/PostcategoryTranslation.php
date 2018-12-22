<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;

class PostcategoryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'post__postcategory_translations';
}
