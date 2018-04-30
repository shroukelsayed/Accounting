<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevenueBenefitItems extends Model
{
    //


    public function revenueBenefits()
    {
    	return $this->belongsToMany(RevenueBenefits::class, 'r_benefit_items' ,'revenue_benefit_item_id', 'revenue_benefit_id')->withPivot('code');
    }
}
