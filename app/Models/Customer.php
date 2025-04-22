<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // Specify the table name if it's not the plural of the model
    protected $table = 'customers';

    // Allow mass assignment on these fields
    protected $fillable = ['name', 'email', 'phone'];

    // Optional: Laravel will automatically manage created_at/updated_at by default
    public $timestamps = true;

    // Relationship with orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
