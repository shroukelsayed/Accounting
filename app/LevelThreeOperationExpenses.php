<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelThreeOperationExpenses extends Model
{
    //
    public function levelTwo(){
        return $this->hasOne(AccountingTreeLevelTwo::class,'parent'); 
    }

    public function LevelFour()
    {
        return $this->hasMany(LevelFourOperationExpenses::class,'parent');
    }

}
