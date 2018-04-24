<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendshipFunds extends Model
{
    //
    public function currentLiability(){
        return $this->hasOne(CurrentLiabilities::class); 
    }

    public function workers()
    {
    	return $this->belongsToMany(Workers::class, 'friendship_fund_workers', 'friendship_fund_id', 'worker_id')->withPivot('code');
    }
}
