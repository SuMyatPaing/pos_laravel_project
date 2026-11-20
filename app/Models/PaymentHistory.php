<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    //
    protected $fillable = [
        'user_name',
        'phone',
        'address',
        'order_code',
        'total_amt',
        'payment_method',
        'payslip_image',
        
    ];
}
