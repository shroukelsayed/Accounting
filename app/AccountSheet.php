<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountSheet extends Model
{
    //

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'sheet_number','sheet_date','type','currency_id','debit','credit','credit_amount','debit_amount','alpha_amount','report','user_id','from_account','to_account','donation_section'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
