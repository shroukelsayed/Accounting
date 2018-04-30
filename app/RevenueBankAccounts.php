<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevenueBankAccounts extends Model
{
    //


    public function revenueBanks()
    {
    	return $this->belongsToMany(RevenueBanks::class, 'r_bank_accounts' ,'revenue_bank_account_id', 'revenue_bank_id')->withPivot('code');
    }
}
