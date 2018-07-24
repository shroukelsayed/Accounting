<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccuredRevenuesFawries extends Model
{
	public function accuredRevenuesItem(){
        return $this->hasOne(AccuredRevenuesItems::class); 
    }    

    public function accuredRevenuesFawriesBanks()
    {
    	return $this->hasMany(AccuredRevenuesFawryBanks::class,'parent');
    }

}
