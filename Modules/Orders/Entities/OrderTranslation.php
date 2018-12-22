<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'orders__order_translations';
}
