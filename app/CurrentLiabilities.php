<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentLiabilities extends Model
{
    //
   	public function levelTwo(){
        return $this->hasOne(AccountingTreeLevelTwo::class); 
    }
}
