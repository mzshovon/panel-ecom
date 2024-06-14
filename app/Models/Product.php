<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'short_description',
        'sku',
        'stock',
        'price',
        'previous_price',
        'tentative_delivery_date',
        'weight',
        'height',
        'discount',
        'discount_type',
        'created_by',
        'updated_by'
    ];

    public function updatedBy()
    {
        return $this->belongsTo(User::class, "id", "updated_by");
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, "id", "created_by");
    }
}
