<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelThreeRevenues extends Model
{
    //
    public function levelTwo(){
        return $this->hasOne(AccountingTreeLevelTwo::class,'parent'); 
    }

    public function LevelFour()
    {
        return $this->hasMany(LevelFourRevenues::class,'parent');
    }

}
