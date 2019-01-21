<?php

namespace Modules\Category\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    protected $table = 'category__categories';
    public $translatedAttributes = [];
    protected $fillable = ['name','parent_id','description','status','slug'];
    public function products(){
        return $this->hasMany('Modules\Products\Entities\Products','category_id','id');
    }
    public function subcategory() {
        $this->belongsTo('Modules\Category\Entities\Category');
    }
}
