<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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
        "status",
        "created_by",
        "updated_by",
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($order) {
            $originalStatus = $order->getOriginal('status');
            $newStatus = $order->status;
            if ($originalStatus == 'pending' && $newStatus == 'confirmed') {
                $order->decrementProductQuantities();
            }
            if ($newStatus == 'returned' || $newStatus == 'cancelled') {
                $order->incrementProductQuantities();
            }
        });

        static::deleting(function ($order) {
            if (!$order->isForceDeleting()) {
                $order->incrementProductQuantities();
            }
        });

        static::restoring(function ($order) {
            $order->decrementProductQuantities();
        });
    }

    public function decrementProductQuantities()
    {
        DB::transaction(function () {
            foreach ($this->products as $orderProduct) {
                $product = $orderProduct->product;
                if ($product->stock >= $orderProduct->quantity) {
                    $product->decrement('stock', $orderProduct->quantity);
                } else {
                    throw new \Exception('Insufficient product quantity for product ID ' . $product->id);
                }
            }
        });
    }

    public function incrementProductQuantities()
    {
        DB::transaction(function () {
            foreach ($this->products as $orderProduct) {
                $product = $orderProduct->product;
                $product->increment('stock', $orderProduct->quantity);
            }
        });
    }

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
