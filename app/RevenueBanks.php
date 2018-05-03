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
        return $this->hasMany(RevenueBankAccounts::class,'parent');
    }
    
}
