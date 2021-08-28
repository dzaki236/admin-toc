<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'invoice', 'customer_id', 'teknisi_id', 'order_id', 'name', 'device', 'order_call', 'description', 'alamat','feedback_teknisi','deskripsi_tindakan', 'jasa_teknisi', 'total_component', 'cost_transport', 'down_payment', 'status', 'grand_total'
    ];

    /**
     * order
     *
     * @return void
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    /**
     * customer
     *
     * @return void
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


}