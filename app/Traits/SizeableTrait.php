<?php
/*
* Author: Arup Kumer Bose
* Email: arupkumerbose@gmail.com
* Company Name: Brainchild Software <brainchildsoft@gmail.com>
*/

namespace App\Traits;

use App\Models\Size;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait SizeableTrait
{
    /**
     * On Delete model Also detach All Sizes.
     *
     * @return void
     */

    protected static function bootHasSizeableTrait(){
        self::deleting(function($model){
            $model->sizes()->detach();
        });
    }

    /**
     * Update Sizeable Data.
     *
     * @param $sizes
     * @return void
     */

    public function updateSizeable($ids)
    {
        try {
            $this->sizes()->sync($ids);
        }catch (\Exception $exception){
            $this->sizes()->detach($ids);
        }
    }

    /**
     * Morph Many to Many relation with sizes.
     *
     * @return MorphToMany
     */

    public function sizes()
    {
        return $this->morphToMany(Size::class, 'sizeable', 'sizeables', null, 'size_id');
    }
}
