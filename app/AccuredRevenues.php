<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccuredRevenues extends Model
{
    //
    public function currentAsset(){
        return $this->hasOne(CurrentAssets::class); 
    }

    public function accuredRevenuesItems()
    {
    	return $this->hasMany(AccuredRevenuesItems::class,'parent');
    }

}
