<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccuredRevenuesFawryBanks extends Model
{
    public function accuredRevenuesFawry(){
        return $this->hasOne(AccuredRevenuesFawries::class); 
    }

}
