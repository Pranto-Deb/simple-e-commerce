<?php
/*
* Author: Arup Kumer Bose
* Email: arupkumerbose@gmail.com
* Company Name: Brainchild Software <brainchildsoft@gmail.com>
*/

namespace App\Traits;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait TaggableTrait
{

    /**
     * On Delete model Also detach All Tags.
     *
     * @return void
     */

    protected static function bootHasTaggableTrait(){
        self::deleting(function($model){
            $model->tags()->detach();
        });
    }

    /**
     * Update Taggable Data.
     *
     * @param $tags
     * @return void
     */

    public function updateTaggable($tags)
    {
        try {
            $this->tags()->sync($tags);
        }catch (\Exception $exception){
            $this->tags()->detach($tags);
        }
    }

    /**
     * Morph Many to Many relation with Tag.
     *
     * @return MorphToMany
     */

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable', 'taggables', null, 'tag_id');
    }
}
