<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixedAssets extends Model
{
    //
    public function levelTwo(){
        return $this->hasOne(AccountingTreeLevelTwo::class); 
    }
}
