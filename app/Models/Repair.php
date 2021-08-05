<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'customer_id', 'order_id', 'hardware', 'description','dp','pickup_address','pickup_datetime','teknisi_id','feedback_teknisi','admin_approval','customer_confirmation','customer_message','fullpay','status'
    ];
}
