<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Specify the table name if it's not the plural of the model
    protected $table = 'orders';

    // Allow mass assignment on these fields
    protected $fillable = ['customer_id', 'order_status', 'total_price', 'payment_id', 'discount_id'];

    // Optional: Laravel will automatically manage created_at/updated_at by default
    public $timestamps = true;

    // Relationship with customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relationship with order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relationship with payment
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    // Relationship with discount
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}
