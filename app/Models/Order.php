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
        'invoice_id', 'invoice', 'product_id', 'product_name', 'image', 'qty', 'price','jenis'
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