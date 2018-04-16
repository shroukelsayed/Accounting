<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    //
    public function currentAsset(){
        return $this->hasOne(CurrentAssets::class); 
    }

}
