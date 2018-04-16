<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banks extends Model
{
    //
    public function currentAsset(){
        return $this->hasOne(CurrentAssets::class); 
    }

    public function bankAccounts()
    {
        return $this->hasMany(BankAccounts::class,'parent');
    }

}
