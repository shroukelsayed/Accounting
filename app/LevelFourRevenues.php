<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelFourRevenues extends Model
{
    //
    public function levelThree(){
        return $this->hasOne(LevelThreeRevenues::class,'parent'); 
    }

    public function notebookLicenses()
    {
        return $this->hasMany(NotebookLicenses::class,'parent');
    }

    public function revenueSms()
    {
        return $this->hasMany(RevenueSms::class,'parent');
    }

    public function revenueMalls()
    {
        return $this->hasMany(RevenueMalls::class,'parent');
    }

    public function revenueFawries()
    {
        return $this->hasMany(RevenueFawries::class,'parent');
    }

    public function revenueBanks()
    {
        return $this->hasMany(RevenueBanks::class,'parent');
    }

    public function revenueBenefits()
    {
        return $this->hasMany(RevenueBenefits::class,'parent');
    }

    public function coupons()
    {
    	return $this->belongsToMany(Coupons::class, 'revenue_coupons', 'level_four_revenue_id', 'coupon_id')->withPivot('code');
    }

}
