<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountingTreeLevelTwo extends Model
{
    //
    public function levelOne(){
        return $this->hasOne(AccountingTreeLevelOne::class,'accounting_tree_level_one_id'); 
    }

    public function fixedAssets()
    {
        return $this->hasMany(FixedAssets::class,'parent');
    }

    public function currentAssets()
    {
        return $this->hasMany(CurrentAssets::class,'parent');
    }

    public function currentLiabilities()
    {
        return $this->hasMany(CurrentLiabilities::class,'parent');
    }

    public function levelThreeOperationExpenses()
    {
        return $this->hasMany(LevelThreeOperationExpenses::class,'parent');
    }

    public function levelThreeGeneralExpenses()
    {
        return $this->hasMany(LevelThreeGeneralExpenses::class,'parent');
    }

    public function levelThreeRevenues()
    {
        return $this->hasMany(LevelThreeRevenues::class,'parent');
    }
}
