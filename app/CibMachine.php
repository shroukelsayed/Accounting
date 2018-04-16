<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CibMachine extends Model
{
    //
    public function currentAsset(){
        return $this->hasOne(CurrentAssets::class); 
    }

}
