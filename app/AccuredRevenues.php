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
    	return $this->belongsToMany(AccuredRevenuesItems::class, 'accured_items','accured_revenue_id' ,'accured_revenues_item_id')->withPivot('code');
    }

}
