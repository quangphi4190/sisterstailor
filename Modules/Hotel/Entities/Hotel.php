<?php

namespace Modules\Hotel\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use Translatable;

    protected $table = 'hotel__hotels';
    public $translatedAttributes = [];
    protected $fillable = ['name','phone','email','address','country_id','state_id','city_id','contact_name','contact_phone','contact_mail','status'];
}
