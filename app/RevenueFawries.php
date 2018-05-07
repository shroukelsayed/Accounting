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
    	return $this->belongsToMany(LevelFourRevenues::class, 'revenue_fawry_items', 'revenue_fawry_id','level_four_revenue_id')->withPivot('code','title');
    }
}
