<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    protected $fillable = [
        'teknisi_id', 'order_id','feedback_teknisi','deskripsi_tindakan', 'jasa_teknisi', 'total_component', 'approval_customer','message','status'
    ];
}
