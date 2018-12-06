<?php

namespace Modules\TourGuide\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class TourGuide extends Model
{
    use Translatable;

    protected $table = 'tourguide__tourguides';
    public $translatedAttributes = [];
    protected $fillable = [];
}
