<?php

namespace Modules\Thongke\Entities;

use Illuminate\Database\Eloquent\Model;

class ThongkehotelTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'thongke__thongkehotel_translations';
}
