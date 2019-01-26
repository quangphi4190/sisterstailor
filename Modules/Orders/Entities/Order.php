<?php

namespace Modules\Orders\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Translatable;

    protected $table = 'orders__orders';
    public $translatedAttributes = [];
    protected $fillable = ['id','name','sdt', 'email', 'address','total','notes','status'];
}
