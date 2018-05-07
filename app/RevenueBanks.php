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
    	return $this->belongsToMany(LevelFourRevenues::class, 'revenue_bank_accounts', 'revenue_bank_id', 'level_four_revenue_id')->withPivot('code','title');
    }
    
}
