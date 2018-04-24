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
    	return $this->belongsToMany(BankAccountItems::class, 'account_items', 'bank_account_id', 'bank_account_item_id')->withPivot('code');
    }
}
