<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountingTreeLevelOne extends Model
{
    //

    public function levelTwo()
    {
        return $this->hasMany(AccountingTreeLevelTwo::class,'parent');
    }

}
