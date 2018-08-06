<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allocations extends Model
{
    //
  
	public function children() {
	    return $this->hasMany(Allocations::class,'level');
	}

	public function parent() {
	    return $this->belongsTo(Allocations::class,'level');
	}

}
