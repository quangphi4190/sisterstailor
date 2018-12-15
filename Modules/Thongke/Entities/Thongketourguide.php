<?php

namespace Modules\Thongke\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Thongketourguide extends Model
{
    use Translatable;

    protected $table = 'thongke__thongketourguides';
    public $translatedAttributes = [];
    protected $fillable = [];
}
