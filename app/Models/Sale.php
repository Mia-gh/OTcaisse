<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'quantity',
        'price',
        'payment_method',
        'status',
        'commentary',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}

// one-to-many relationship between sales and payments.
//  A sale can have many payments, but each payment is
//  associated with one sale.
