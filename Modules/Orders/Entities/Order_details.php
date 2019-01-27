<?php

namespace Modules\Orders\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    use Translatable;

    protected $table = 'orders__order_details';
    public $translatedAttributes = [];
    protected $fillable = ['id','order_id','product_id','price','quantity'];
}
