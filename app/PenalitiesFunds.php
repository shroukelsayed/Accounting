<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenalitiesFunds extends Model
{
    //
    public function currentLiability(){
        return $this->hasOne(CurrentLiabilities::class); 
    }

    public function workers()
    {
    	return $this->belongsToMany(Workers::class, 'penalities_fund_workers', 'penalities_fund_id', 'worker_id')->withPivot('code');
    }
}
