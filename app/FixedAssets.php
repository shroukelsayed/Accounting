<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixedAssets extends Model
{
    //
    public function levelOne(){
        return $this->hasOne(AccountingTreeLevelTwo::class); 
    }
}
