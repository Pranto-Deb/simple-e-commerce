<?php

namespace App\Models;

use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';
    protected $primaryKey='tag_id';

    protected $fillable=[
        'tag_name'
    ];


    public function products()
    {
        return $this->morphedByMany(Product::class, 'taggable', 'taggables', 'tag_id', 'taggable_id', 'tag_id');
    }
}
