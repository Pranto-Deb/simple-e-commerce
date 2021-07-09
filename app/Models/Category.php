<?php

namespace App\Models;

use App\Models\Product;
use App\Traits\HasAttachmentTrait;
use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use HasAttachmentTrait;
    use HasFilter;

    protected $table='categories';
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'parent_id',
        'category_name',
        'position',
        'status',
    ];

    public function subcategories(){
    	return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(){
    	return $this->hasOne(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id', 'category_id')->orderBy('position', 'asc');
    }

}
