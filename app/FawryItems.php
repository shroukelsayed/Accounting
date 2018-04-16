<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FawryItems extends Model
{
    //
    public function fawry(){
        return $this->hasOne(Fawry::class); 
    }

    public function fawryBanks()
    {
        return $this->hasMany(FawryBanks::class,'parent');
    }

}
