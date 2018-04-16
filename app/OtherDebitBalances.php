<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherDebitBalances extends Model
{
    //
    public function currentAsset(){
        return $this->hasOne(CurrentAssets::class); 
    }

}
