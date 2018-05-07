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
    	return $this->belongsToMany(LevelFourRevenues::class, 'revenue_benefit_items' , 'revenue_benefit_id','level_four_revenue_id')->withPivot('code','title');
    }
}
