<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PropertyListingType extends Model
{
    protected $table = 'property_listing_type';

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class, 'property_listing_types_id');
    }
}
