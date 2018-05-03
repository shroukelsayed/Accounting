<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevenueBankAccounts extends Model
{
    //


    public function revenueBanks()
    {
        return $this->hasOne(RevenueBanks::class,'parent'); 
    }

}
