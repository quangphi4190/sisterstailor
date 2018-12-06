<?php

namespace Modules\Invoices\Entities;

use Illuminate\Database\Eloquent\Model;

class InvoiceTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'invoices__invoice_translations';
}
