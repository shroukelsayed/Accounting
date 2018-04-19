<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    //
    public function currentAsset(){
        return $this->hasOne(CurrentAssets::class); 
    }

    public function storeItems()
    {
        return $this->hasMany(StoreItems::class,'parent');
    }

}
