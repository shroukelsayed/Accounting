<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayableCheques extends Model
{
    //
    public function currentLiability(){
        return $this->hasOne(CurrentLiabilities::class); 
    }

}
