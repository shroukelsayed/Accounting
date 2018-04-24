<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensesItems extends Model
{
    //
    public function advancedExpenses()
    {
    	return $this->belongsToMany(AdvancedExpenses::class, 'advanced_expense_expenses_items', 'expenses_item_id','advanced_expense_id')->withPivot('code');
    }

    public function accuredExpenses()
    {
    	return $this->belongsToMany(AccuredExpenses::class, 'accured_expense_items', 'expenses_item_id','accured_expense_id')->withPivot('code');
    }

    public function operationExpenses()
    {
    	return $this->belongsToMany(LevelFourOperationExpenses::class, 'operation_expense_items' , 'expenses_item_id' , 'operation_expense_id')->withPivot('code');
    }

    public function generalExpenses()
    {
    	return $this->belongsToMany(LevelFourGeneralExpenses::class, 'general_expense_items' , 'expenses_item_id' , 'general_expense_id')->withPivot('code');
    }

}
