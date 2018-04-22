<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelFourGeneralExpenses extends Model
{
    //
    public function LevelThree(){
        return $this->hasOne(LevelThreeGeneralExpenses::class); 
    }

    public function expensesItems()
    {
    	return $this->belongsToMany(ExpensesItems::class, 'general_expense_items', 'general_expense_id', 'expenses_item_id');
    }

}
