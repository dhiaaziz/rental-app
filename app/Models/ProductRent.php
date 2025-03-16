<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductRent extends Model
{
    use HasFactory;

    protected $table = 'product_rents';

    protected $fillable = [
        'user_id',
        'product_id',
        'start_time',
        'end_time',
        'payment_method',
        // 'google_event_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
