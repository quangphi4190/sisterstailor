<?php

namespace Modules\Customers\Entities;

use Illuminate\Database\Eloquent\Model;

class CustomerTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'customers__customer_translations';
}
