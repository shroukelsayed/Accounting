<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuppliersCreditors extends Model
{
    //
    public function suppliers(){
        return $this->hasOne(Suppliers::class); 
    }

}
