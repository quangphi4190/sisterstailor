<?php

namespace Modules\Hotel\Entities;

use Illuminate\Database\Eloquent\Model;

class HotelTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','phone','email','address','contact_name','contact_phone','contact_mail','status'];
    protected $table = 'hotel__hotel_translations';
}
