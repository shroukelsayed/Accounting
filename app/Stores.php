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

    public function storeLogs()
    {
        return $this->hasMany(StoreLogs::class,'store_id');
    }

}
