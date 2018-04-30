<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevenueFawryItems extends Model
{
    //
    public function revenueFawries(){
    	return $this->belongsToMany(RevenueFawries::class, 'r_fawry_items','revenue_fawry_item_id', 'revenue_fawry_id')->withPivot('code');
    }
}
