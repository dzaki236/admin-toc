<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'teknisi_id', 'order_id', 'component','feedback_teknisi','deskripsi_tindakan','approval_customer','message','status'
    ];
}
