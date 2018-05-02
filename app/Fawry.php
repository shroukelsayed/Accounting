<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fawry extends Model
{
    //
    public function currentAsset(){
        return $this->hasOne(CurrentAssets::class); 
    }

    public function fawryItems()
    {
    	return $this->hasMany(FawryItems::class, 'parent');
    }
}
