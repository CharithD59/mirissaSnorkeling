<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GalleryImage extends Model
{
    protected $fillable = [
        'title', 'caption', 'category', 'image', 'alt', 'show_on_home', 'show_in_gallery', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'show_on_home'    => 'boolean',
        'show_in_gallery' => 'boolean',
        'is_active'       => 'boolean',
        'sort_order'      => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function getCategorySlugAttribute()
    {
        return Str::slug($this->category ?: 'other', '_');
    }
}
