<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cash','amount','alpha_amount','notes','type','receipt_date','cheque_number','cheque_bank','cheque_date','for_account','user_id','delivered_by'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


}
