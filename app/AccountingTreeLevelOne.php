<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountingTreeLevelOne extends Model
{
    //

    public function levelTwo()
    {
        return $this->hasMany(AccountingTreeLevelTwo::class,'accounting_tree_level_one_id');
    }

}
