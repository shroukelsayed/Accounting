<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustodyAndAdvances extends Model
{
    //
    public function currentAsset(){
        return $this->hasOne(CurrentAssets::class); 
    }

    public function workers()
    {
    	return $this->belongsToMany(Workers::class, 'custody_and_advance_workers', 'custody_and_advance_id', 'worker_id');
    }
}
