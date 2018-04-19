<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositsWithOthers extends Model
{
    //
    public function currentAsset(){
        return $this->hasOne(CurrentAssets::class); 
    }

    public function depositsWithOtherItems()
    {
        return $this->hasMany(DepositsWithOtherItems::class,'parent');
    }
}
