<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccounts extends Model
{
    //
    public function bank(){
        return $this->hasOne(Bank::class); 
    }

    public function bankAccountItems()
    {
        return $this->hasMany(BankAccountItems::class,'parent');
    }
}
