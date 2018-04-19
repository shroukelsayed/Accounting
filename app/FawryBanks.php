<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FawryBanks extends Model
{
    //
    public function fawryItem(){
    	return $this->belongsToMany(FawryFawryItems::class, 'fawry_item_banks', 'fawry_bank_id','fawry_item_id');
    }

}
