<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccountItems extends Model
{
    //
    public function bankAccount(){
        return $this->hasOne(BankAccounts::class); 
    }

}
