<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenalitiesFunds extends Model
{
    //
    public function currentLiability(){
        return $this->hasOne(CurrentLiabilities::class); 
    }

}
