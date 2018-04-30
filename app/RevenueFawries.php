<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevenueFawries extends Model
{
    //
    public function levelFour(){
        return $this->hasOne(LevelFourRevenues::class,'parent'); 
    }

     public function revenueFawryItems(){
    	return $this->belongsToMany(RevenueFawryItems::class, 'r_fawry_items', 'revenue_fawry_id','revenue_fawry_item_id')->withPivot('code');
    }
}
