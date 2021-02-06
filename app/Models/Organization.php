<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilterBy($query, $filters)
    {
        $query->when($filters['search'] ?? null, function ($query) use ($filters) {
            $search = '%' . $filters['search'] . '%';

            return $query->where('name', 'like', $search)
                ->orWhere('city', 'like', $search)
                ->orWhere('phone', 'like', $search);
        });
    }
}
