<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentLiabilities extends Model
{
    //
   	public function levelTwo(){
        return $this->hasOne(AccountingTreeLevelTwo::class); 
    }

    public function suppliers()
    {
        return $this->hasMany(Suppliers::class,'parent');
    }

    public function accuredExpenses()
    {
        return $this->hasMany(AccuredExpenses::class,'parent');
    }
   
    public function payableCheques()
    {
        return $this->hasMany(PayableCheques::class,'parent');
    }
   
    public function taxes()
    {
        return $this->hasMany(Taxes::class,'parent');
    }
   
    public function socialInsurances()
    {
        return $this->hasMany(SocialInsurances::class,'parent');
    }
   
    public function penalitiesFunds()
    {
        return $this->hasMany(PenalitiesFunds::class,'parent');
    }
   
    public function friendshipFunds()
    {
        return $this->hasMany(FriendshipFunds::class,'parent');
    }
   
    public function amountsUnderAdjustments()
    {
        return $this->hasMany(AmountsUnderAdjustments::class,'parent');
    }
   
    public function creditors()
    {
        return $this->hasMany(Creditors::class,'parent');
    }

}
