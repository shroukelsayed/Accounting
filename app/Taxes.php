<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxes extends Model
{
    //
    public function currentLiability(){
        return $this->hasOne(CurrentLiabilities::class); 
    }

}
