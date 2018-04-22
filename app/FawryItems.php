<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FawryItems extends Model
{
    //
    public function fawry(){
    	return $this->belongsToMany(Fawry::class, 'fawry_fawry_items', 'fawry_item_id','fawry_id');
    }

    

}
