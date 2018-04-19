<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workers extends Model
{
  
    public function custodyAndAdvance()
    {
    	return $this->belongsToMany(CustodyAndAdvances::class, 'custody_and_advance_workers', 'worker_id', 'custody_and_advance_id');
    }
}
