<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivableCheques extends Model
{
    //
    public function currentAsset(){
        return $this->hasOne(CurrentAssets::class); 
    }

}
