<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialInsurances extends Model
{
    //
    public function currentLiability(){
        return $this->hasOne(CurrentLiabilities::class); 
    }

    public function socialInsuranceItems(){
    	return $this->belongsToMany(SocialInsuranceItems::class, 'insurance_items', 'social_insurance_id','social_insurance_item_id');
    }
}
