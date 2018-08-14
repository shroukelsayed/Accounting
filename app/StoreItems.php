<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreItems extends Model
{
    //
    public function Store(){
        return $this->hasOne(Stores::class); 
    }

   	public function storeItemLogs()
    {
        return $this->hasMany(StoreLogs::class,'item_id');
    }
}
