<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentAssets extends Model
{
    //
    public function levelTwo(){
        return $this->hasOne(AccountingTreeLevelTwo::class,'parent'); 
    }

    public function banks()
    {
        return $this->hasMany(Banks::class,'parent');
    }

    public function treasury()
    {
        return $this->hasMany(Treasury::class,'parent');
    }

    public function advancedExpenses()
    {
        return $this->hasMany(AdvancedExpenses::class,'parent');
    }

    public function depositsWithOthers()
    {
        return $this->hasMany(DepositsWithOthers::class,'parent');
    }

    public function custodyAndAdvances()
    {
        return $this->hasMany(CustodyAndAdvances::class,'parent');
    }

    public function accuredRevenues()
    {
        return $this->hasMany(AccuredRevenues::class,'parent');
    }

    public function variousDebitors()
    {
        return $this->hasMany(VariousDebitors::class,'parent');
    }

    public function otherDebitBalances()
    {
        return $this->hasMany(OtherDebitBalances::class,'parent');
    }

    public function stores()
    {
        return $this->hasMany(Stores::class,'parent');
    }

    public function receivableCheques()
    {
        return $this->hasMany(ReceivableCheques::class,'parent');
    }

    public function fawry()
    {
        return $this->hasMany(Fawry::class,'parent');
    }

    public function sms()
    {
        return $this->hasMany(Sms::class,'parent');
    }

    public function cibMachine()
    {
        return $this->hasMany(CibMachine::class,'parent');
    }
       
}
