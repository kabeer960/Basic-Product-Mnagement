<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    Protected $primaryKey = 'order_id';
    public function product(){
      return $this->hasOne(Product::class, 'product_id');
    } 
}
