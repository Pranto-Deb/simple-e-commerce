<?php

namespace App\Models;

use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = 'sizes';
    protected $primaryKey='size_id';

    protected $fillable=[
        'size_name'
    ];


    public function products()
    {
        return $this->morphedByMany(Product::class, 'sizeable', 'sizeables', 'size_id', 'sizeable_id', 'size_id');
    }
}
