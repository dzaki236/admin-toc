<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;
     
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['order_id', 'product_id', 'name', 'image', 'qty', 'price', 'total_price'];
}
