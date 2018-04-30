<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    //
    public function levelFour(){
    	return $this->belongsToMany(LevelFourRevenues::class, 'revenue_coupons', 'coupon_id', 'level_four_revenue_id')->withPivot('code');
    }

}
