<?php

namespace Modules\Advertisements\Entities;

use Illuminate\Database\Eloquent\Model;

class AdvertisementTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'advertisements__advertisement_translations';
}
