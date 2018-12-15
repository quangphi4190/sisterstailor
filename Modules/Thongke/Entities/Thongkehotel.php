<?php

namespace Modules\Thongke\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Thongkehotel extends Model
{
    use Translatable;

    protected $table = 'thongke__thongkehotels';
    public $translatedAttributes = [];
    protected $fillable = [];
}
