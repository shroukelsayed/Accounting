<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentLiabilities extends Model
{
    //
    public function levelOne(){
        return $this->hasOne(AccountingTreeLevelOne::class); 
    }
}
