<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccuredRevenuesItems extends Model
{
    //
    public function accuredRevenue()
    {
    	return $this->belongsToMany(AccuredRevenues::class, 'accured_items','accured_revenues_item_id','accured_revenue_id');
    }

}
