<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialInsuranceItems extends Model
{
    //
    public function socialInsurance(){
    	return $this->belongsToMany(SocialInsurance::class, 'insurance_items', 'social_insurance_item_id','social_insurance_id')->withPivot('code');
    }

}
