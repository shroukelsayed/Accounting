<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FawryFawryItems extends Model
{
    //
    public function fawryBanks()
    {
    	return $this->belongsToMany(FawryBanks::class, 'fawry_item_banks','fawry_item_id', 'fawry_bank_id');
    }

}
