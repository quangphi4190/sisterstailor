<?php

namespace Modules\Hotel\Entities;

use Illuminate\Database\Eloquent\Model;

class HotelTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'hotel__hotel_translations';
}
