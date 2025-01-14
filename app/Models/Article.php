<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 


class Article extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
        'price',
        'quantity',
        'quantity_alert',
        'category_id',
        'image',
        'description',
        'reference',
        'status',
     ];


public function category(): BelongsTo
{
    return $this->belongsTo(Category::class);
}
}


// BelongsTo relationship : used to define a one-to-one or many-to-one relantshiop between two models.

// fillable : indique les colonnes 'remplissables' ( id, created-at se font automatiquement)
// The protected $fillable property in a Laravel model class is used to specify which attributes are allowed to be mass assigned.
// By default, Laravel protects against mass assignment vulnerabilities, which can occur when unexpected HTTP request fields are
//  used to change columns in the database that were not intended. To prevent this, you need to explicitly define which attributes
//  can be mass assigned using the $fillable property.

