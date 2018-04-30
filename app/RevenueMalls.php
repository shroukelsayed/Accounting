<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevenueMalls extends Model
{
    //
    public function levelFour(){
        return $this->hasOne(LevelFourRevenues::class,'parent'); 
    }

}
