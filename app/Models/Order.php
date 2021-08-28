<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * fillable
     * untuk jasa akan gabung dengan order di model ini , dengan gambar dan product id kategori jasa dinamis db, qty 1 default
     *
     * @var array
     */
    protected $fillable = [
        'kode_order','customer_id', 'name', 'device', 'order_call', 'description', 'alamat', 'cost_transport', 'down_payment', 'status'
    ];

    /**
     * invoice
     *
     * @return void
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}