<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccountItems extends Model
{
    //

    public function bankAccount()
    {
    	return $this->belongsToMany(BankAccounts::class, 'account_items', 'bank_account_item_id','bank_account_id')->withPivot('code');
    }
}
