<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasFactory;

    protected $table = 'attachments';

    protected $primaryKey = 'id';

    protected $fillable =[
        'url',
        'attachmentable_id',
        'attachmentable_type',
    ];

    protected $appends = ['image_path'];

    public function getImagePathAttribute(): string
    {
        return $this->url
            ? asset('storage/'.$this->url)
            : $this->_defaultImagePath();
    }

    private function _defaultImagePath(): string
    {
            return asset('images/no-image-available.jpg');
    }

    /**
     * Get the owning attachmentable model.
     */
    public function attachmentable()
    {
        return $this->morphTo();
    }
}
