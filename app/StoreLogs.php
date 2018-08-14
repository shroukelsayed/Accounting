<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreLogs extends Model
{
    //
    
    public function storeItem(){
		return $this->belongsTo(StoreItems::class,'item_id','id'); 
    }

    public function store(){
		return $this->belongsTo(Stores::class); 
    }

}
