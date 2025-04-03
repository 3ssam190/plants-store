<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Plant extends Model
{

    use SoftDeletes;
    protected $fillable = [
        'name',
        'type',
        'price',
        'environment',
        'image_path'
    ];

    // Accessor for image URL
    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('storage/'.$this->image_path) : asset('images/default-plant.jpg');
    }

    // Additional accessors
    public function getFormattedPriceAttribute()
    {
        return '$'.number_format($this->price, 2);
    }

    public function getTypeLabelAttribute()
    {
        return match($this->type) {
            'flower' => '🌼 Flower',
            'succulent' => '🌵 Succulent',
            'tree' => '🌳 Tree',
            default => $this->type
        };
    }
}