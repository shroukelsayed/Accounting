<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreasuryCurrencies extends Model
{
    //

    public function currencies()
    {
    	return $this->belongsToMany(Treasury::class, 'currencies','treasury_currency_id', 'treasury_id')->withPivot('code');
    }
}
