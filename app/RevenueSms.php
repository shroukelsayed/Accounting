<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevenueSms extends Model
{
    //
    public function levelFour(){
        return $this->hasOne(LevelFourRevenues::class,'parent'); 
    }

}
