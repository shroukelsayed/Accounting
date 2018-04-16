<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creditors extends Model
{
    //
    public function currentLiability(){
        return $this->hasOne(CurrentLiabilities::class); 
    }

}
