<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentAssets extends Model
{
    //
    public function levelOne(){
        return $this->hasOne(AccountingTreeLevelOne::class); 
    }
}
