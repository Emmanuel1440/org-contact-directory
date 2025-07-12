<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];
    public function organizations()
    {
        return $this->hasMany(Organization::class, 'industry_id');
    }
    
}
