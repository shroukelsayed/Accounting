<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvancedExpenses extends Model
{
    //
    public function currentAsset(){
        return $this->hasOne(CurrentAssets::class); 
    }

    public function expensesItems()
    {
    	return $this->belongsToMany(ExpensesItems::class, 'advanced_expense_expenses_items', 'advanced_expense_id', 'expenses_item_id')->withPivot('code');
    }

}
