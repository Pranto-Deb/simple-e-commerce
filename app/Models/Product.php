<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Brand;
use App\Traits\HasAttachmentTrait;
use App\Traits\HasFilter;
use App\Traits\SizeableTrait;
use App\Traits\TaggableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use HasAttachmentTrait;
    use HasFilter;
    use TaggableTrait;
    use SizeableTrait;

    protected $table = 'products';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_name',
        'cat_id',
        'br_id',
        'product_details',
        'product_features',
        'product_price',
        'product_quantity',
        'product_meta',
        'position',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'br_id', 'brand_id');
    }

}
