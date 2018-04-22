<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelFourOperationExpenses extends Model
{
    //
    public function LevelThree(){
        return $this->hasOne(LevelThreeOperationExpenses::class); 
    }

    public function expensesItems()
    {
    	return $this->belongsToMany(ExpensesItems::class, 'operation_expense_items', 'operation_expense_id', 'expenses_item_id');
    }

}
