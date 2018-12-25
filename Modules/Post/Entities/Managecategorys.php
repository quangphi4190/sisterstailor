<?php

namespace Modules\Post\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;
class Managecategorys extends Model
{
    use Translatable, MediaRelation;
    protected $table = 'post__managecategorys';   
    public $translatedAttributes = [];
    protected $fillable = ['category_id','name','description','slug','status'];
    protected $with = ['files'];
}
