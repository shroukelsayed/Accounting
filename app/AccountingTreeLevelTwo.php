<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountingTreeLevelTwo extends Model
{
    //
    public function levelOne(){
        return $this->hasOne(AccountingTreeLevelOne::class); 
    }

    public function fixedAssets()
    {
        return $this->hasMany(FixedAssets::class,'parent');
    }
}
