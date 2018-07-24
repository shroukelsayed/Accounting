<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccuredRevenuesItems extends Model
{
    //
    public function accuredRevenue()
    {
    	return $this->hasOne(AccuredRevenues::class);
    }

    public function accuredRevenuesFawries()
    {
    	return $this->hasMany(AccuredRevenuesFawries::class,'parent');
    }
}
