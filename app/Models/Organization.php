<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    // ✅ Add this to allow mass-assignment when creating/updating
    protected $fillable = [
        'name',
        'industry_id',
        'website',
        'tax_id',
        'is_active',
    ];

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
