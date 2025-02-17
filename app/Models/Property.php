<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
{
    use HasFactory;

    public function list_type(): BelongsTo
    {
        return $this->belongsTo(PropertyListingType::class, 'property_listing_types_id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }


    public function getPriceAsCurrency()
    {
        return Number::currency($this->price);
    }

    public function getPriceBySquareFeet()
    {
        return Number::currency($this->price / $this->sq_ft);
    }
}
