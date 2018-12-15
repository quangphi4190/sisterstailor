<?php

namespace Modules\Thongke\Entities;

use Illuminate\Database\Eloquent\Model;

class ThongketimeTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'thongke__thongketime_translations';
}
