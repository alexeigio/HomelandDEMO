<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['property_id', 'name', 'email', 'description', 'date', 'rating'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
