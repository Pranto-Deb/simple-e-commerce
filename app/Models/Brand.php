<?php

namespace App\Models;

use App\Models\Product;
use App\Traits\HasAttachmentTrait;
use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    use HasAttachmentTrait;
    use HasFilter;

    protected $table='brands';
    protected $primaryKey = 'brand_id';

    protected $fillable = [
        'brand_name',
        'brand_details',
        'position',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'br_id', 'brand_id')->orderBy('position', 'asc');
    }
}
