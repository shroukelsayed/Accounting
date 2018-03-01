<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
            return $this->belongsTo(Role::class);
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    public function donationReceipts()
    {
        return $this->hasMany(DonationReceipt::class);
    }
    
    public function accountSheets()
    {
        return $this->hasMany(AccountSheet::class);
    }
}
