<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationReceipt extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'cash','amount','alpha_amount','notes','type','receipt_date','cheque_number','cheque_bank','cheque_date','donator_name','donator_address','donator_mobile','is_approved','project_id','receipt_writter_id','receipt_delegate_id','receipt_notebook','receipt_for_month','donation_section','collecting_type','user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
