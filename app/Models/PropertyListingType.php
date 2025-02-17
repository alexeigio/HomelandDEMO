<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyListingType extends Model
{
    protected $table = 'property_listing_type';

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
