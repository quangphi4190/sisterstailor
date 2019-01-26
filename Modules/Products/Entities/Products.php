<?php

namespace Modules\Products\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Media\Support\Traits\MediaRelation;

class Products extends Model
{
    use Translatable, MediaRelation;

    protected $table = 'products__products';
    public $translatedAttributes = [];
    protected $fillable = ['name', 'gallery', 'intro', 'description', 'price', 'price_discount', 'status', 'category_id', 'featured', 'slug'];
    protected $with = ['files'];

    public function category()
    {
        return $this->belongsTo('Modules\Category\Entities\Category', 'category_id');
    }
}
