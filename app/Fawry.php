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
    	return $this->belongsToMany(FawryItems::class, 'fawry_fawry_items', 'fawry_id','fawry_item_id')->withPivot('code');
    }
}
