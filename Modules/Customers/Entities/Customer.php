<?php

namespace Modules\Customers\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use Translatable;

    protected $table = 'customers__customers';
    public $translatedAttributes = [];
    protected $fillable = [
        'customer_type',
        'firstname',
        'lastname',
        'gender',
        'mail',
        'phone',
        'address',
        'country_id',
        'state_id',
        'city_id',
        'status',
        'custom_field1',
        'custom_field2',
        'custom_field3',

    ];
}
