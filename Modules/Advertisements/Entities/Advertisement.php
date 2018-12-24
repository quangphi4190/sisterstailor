<?php

namespace Modules\Advertisements\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;

class Advertisement extends Model
{
    use Translatable, MediaRelation;

    protected $table = 'advertisements__advertisements';
    public $translatedAttributes = [];
    protected $fillable = ['name','image','note','status','position'];
    protected $with = ['files'];
}
