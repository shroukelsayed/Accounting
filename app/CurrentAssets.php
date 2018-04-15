<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentAssets extends Model
{
    //
    public function levelTwo(){
        return $this->hasOne(AccountingTreeLevelTwo::class); 
    }

    public function banks()
    {
        return $this->hasMany(Banks::class,'parent');
    }
}