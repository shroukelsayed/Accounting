<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustodySheets extends Model
{
    
    public function worker(){
		return $this->belongsTo(Workers::class,'worker_id','id'); 
    }

}
