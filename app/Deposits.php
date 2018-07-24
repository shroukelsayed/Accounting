<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposits extends Model
{
    //
    public function currentAsset(){
        return $this->hasOne(CurrentAssets::class); 
    }

}
