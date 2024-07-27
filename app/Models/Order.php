<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

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
        "status_update_info",
        "invoice_no",
        "merchant_id",
        "courier",
        "order_from",
        "notes",
        "created_by",
        "updated_by",
    ];

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    // Accessor for updated_at
    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }
}
