<?php

namespace Modules\Contact\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use Translatable;

    protected $table = 'contact__contacts';
    public $translatedAttributes = [];
    protected $fillable = ['first_name','last_name','address','email','phone','description','status'];
}
