<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'published_at'
    ];

    public function donationReceipts()
    {
        return $this->hasMany(DonationReceipt::class);
    }

    public function licenseReceipts()
    {
        return $this->hasMany(LicenseReceipt::class);
    }
}
