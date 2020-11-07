<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeMyShopsAndActive($query)
    {
        return $query->whereHas('store', function($q){
            $q->where('user_id', Auth::user()->id)->where('status', 1);
        });
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
