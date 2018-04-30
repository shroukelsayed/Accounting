<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevenueBanks extends Model
{
    //
    public function levelFour(){
        return $this->hasOne(LevelFourRevenues::class,'parent'); 
    }

    public function revenueBankAccounts()
    {
    	return $this->belongsToMany(RevenueBankAccounts::class, 'r_bank_accounts' , 'revenue_bank_id','revenue_bank_account_id')->withPivot('code');
    }
}
