<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    //
    public function currentLiability(){
        return $this->hasOne(CurrentLiabilities::class); 
    }

    public function suppliersCreditors()
    {
        return $this->hasMany(SuppliersCreditors::class,'parent');
    }
}
