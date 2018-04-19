<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositsWithOtherItems extends Model
{
    //
    public function depositsWithOther(){
        return $this->hasOne(DepositsWithOthers::class); 
    }

}
