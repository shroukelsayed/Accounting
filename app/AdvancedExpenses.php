<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvancedExpenses extends Model
{
    //
    public function currentAsset(){
        return $this->hasOne(CurrentAssets::class); 
    }

}
