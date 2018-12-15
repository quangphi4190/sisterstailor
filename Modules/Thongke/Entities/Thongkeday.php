<?php

namespace Modules\Thongke\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Thongkeday extends Model
{
    use Translatable;

    protected $table = 'thongke__thongkedays';
    public $translatedAttributes = [];
    protected $fillable = [];
}
