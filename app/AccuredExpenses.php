<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccuredExpenses extends Model
{
    //
    public function currentLiability(){
        return $this->hasOne(CurrentLiabilities::class); 
    }


    public function expensesItems()
    {
    	return $this->belongsToMany(ExpensesItems::class, 'accured_expense_items', 'accured_expense_id', 'expenses_item_id');
    }

}
