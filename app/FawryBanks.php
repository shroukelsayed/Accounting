<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FawryBanks extends Model
{
    //
    public function fawryItems(){
        return $this->hasOne(FawryItemss::class); 
    }

}
