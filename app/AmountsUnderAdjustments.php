<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmountsUnderAdjustments extends Model
{
    //
    public function currentLiability(){
        return $this->hasOne(CurrentLiabilities::class); 
    }

}
