<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workers extends Model
{
  
    public function custodyAndAdvance()
    {
    	return $this->belongsToMany(CustodyAndAdvances::class, 'custody_and_advance_workers', 'worker_id', 'custody_and_advance_id')->withPivot('code');
    }

    public function penalitiesFunds()
    {
    	return $this->belongsToMany(PenalitiesFunds::class, 'penalities_fund_workers' , 'worker_id' , 'penalities_fund_id')->withPivot('code');
    }

    public function friendshipFunds()
    {
    	return $this->belongsToMany(FriendshipFunds::class, 'friendship_fund_workers' , 'worker_id' , 'friendship_fund_id')->withPivot('code');
    }

    public function custodySheets()
    {
        return $this->hasMany(CustodySheets::class,'worker_id');
    }
}
