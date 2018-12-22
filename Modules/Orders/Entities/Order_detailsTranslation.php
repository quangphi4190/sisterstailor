<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;

class Order_detailsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'orders__order_details_translations';
}
