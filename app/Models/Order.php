<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "quantity",
        "total_amount",
        "total_discount",
        "total_amount_after_discount",
        "shipping_charge",
        "payment_type",
        "name",
        "mobile",
        "email",
        "address",
        "notes",
        "created_by",
        "updated_by",
    ];
}
