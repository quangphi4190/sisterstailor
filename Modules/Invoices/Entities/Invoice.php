<?php

namespace Modules\Invoices\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use Translatable;

    protected $table = 'invoices__invoices';
    public $translatedAttributes = [];
    protected $fillable = [
        'customer_id',
        'tour_guide_id',
        'hotel_id',
        'order_date',
        'product',
        'price',
        'discount',
        'payment_type',
        'delivery_date',
        'delivery_address',
        'delivery_name',
        'delivery_phone',
        'delivery_note',
        'billing_name',
        'billing_phone',
        'status',
        'note',
        'group_code',
        'is_group'
    ];
}
