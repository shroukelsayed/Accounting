<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevenueBenefits extends Model
{
    //
    public function levelFour(){
        return $this->hasOne(LevelFourRevenues::class,'parent'); 
    }

    public function revenueBenefitItems()
    {
    	return $this->belongsToMany(RevenueBenefitItems::class, 'r_benefit_items' , 'revenue_benefit_id','revenue_benefit_item_id')->withPivot('code');
    }
}
