<?php

namespace Modules\Tourguide\Entities;

use Illuminate\Database\Eloquent\Model;

class TourGuideTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'tourguide__tourguide_translations';
}
