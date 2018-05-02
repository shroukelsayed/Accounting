<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FawryItems extends Model
{
    //
    public function fawry(){
        return $this->hasOne(Fawry::class); 
    }

    public function fawryItemBanks(){
    	return $this->belongsToMany(FawryBanks::class, 'fawry_item_banks','fawry_item_id', 'fawry_bank_id')->withPivot('code');
    }

}
