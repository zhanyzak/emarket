<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class Store extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function save(array $options = [])
    {
        if(!$this->user_id && Auth::user())
        {
            $this->user_id = Auth::user()->id;
        }

        parent::save();
    }

    public function scopeCurrentUser($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    protected static function booted()
    {
        if(Auth::check())
        {
            static::addGlobalScope('user_id', function(Builder $builder){
                $builder->where('user_id', Auth::user()->id);
            });
        }
    }
}
