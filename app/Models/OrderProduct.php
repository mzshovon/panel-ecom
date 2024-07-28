<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class OrderProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "quantity",
        "order_id",
        "product_id",
        "price",
        "created_by",
        "updated_by",
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($orderProduct) {
            $originalQty = $orderProduct->getOriginal('quantity');
            $newQty = $orderProduct->quantity;
            if ($newQty > $originalQty) {
                $orderProduct->decrementProductQuantities(($newQty - $originalQty));
            }else if ($newQty < $originalQty) {
                $orderProduct->incrementProductQuantities(($originalQty - $newQty));
            }
        });

        static::deleting(function ($orderProduct) {
            $originalQty = $orderProduct->getOriginal('quantity');
            if (!$orderProduct->isForceDeleting()) {
                $orderProduct->incrementProductQuantities($originalQty);
            }
        });

        static::restoring(function ($orderProduct) {
            $orderProduct->decrementProductQuantities();
        });
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function decrementProductQuantities($updatedQty)
    {
        DB::transaction(function () use ($updatedQty){
            $product = $this->product;
            if($updatedQty <= $product->quantity){
                $product->decrement('stock', $updatedQty);
            } else {
                throw new \Exception('Insufficient product quantity for product ID ' . $product->id);
            }
        });
    }

    public function incrementProductQuantities($updatedQty)
    {
        DB::transaction(function () use ($updatedQty){
            $product = $this->product;
            $product->increment('stock', $updatedQty);
        });
    }
}
