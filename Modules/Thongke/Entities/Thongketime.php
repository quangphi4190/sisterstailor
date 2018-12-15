<?php

namespace Modules\Thongke\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Thongketime extends Model
{
    use Translatable;

    protected $table = 'thongke__thongketimes';
    public $translatedAttributes = [];
    protected $fillable = [];
}
