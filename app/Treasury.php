<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treasury extends Model
{
    //
    public function currentAsset(){
        return $this->hasOne(CurrentAssets::class); 
    }

    public function treasuryCurrencies()
    {
    	return $this->belongsToMany(TreasuryCurrencies::class, 'currencies', 'treasury_id','treasury_currency_id')->withPivot('code');
    }

}
