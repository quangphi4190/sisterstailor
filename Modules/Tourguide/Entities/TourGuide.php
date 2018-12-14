<?php

namespace Modules\Tourguide\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class TourGuide extends Model
{
    use Translatable;

    protected $table = 'tourguide__tourguides';
    public $translatedAttributes = [];
    protected $fillable = [
        'tour_guide_type',
        'firstname',
        'lastname',
        'gender',
        'email',
        'phone',
        'address',
        'country_id',
        'state_id',
        'city_id',
        'company',
        'status',
        'custom_field1',
        'custom_field2',
        'custom_field3',
    ];
}
