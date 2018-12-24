<?php

namespace Modules\Banner\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;

class Banner extends Model
{
    use Translatable, MediaRelation;

    protected $table = 'banner__banners';
    public $translatedAttributes = [];
    protected $fillable = ['name','image','link','description','status'];
    protected $with = ['files'];
}
