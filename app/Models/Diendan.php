<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Diendan extends Model
{
    use HasFactory;

    protected $table = 'diendan';
    
    protected $fillable = [
        'ma_dien_dan',
        'ten_dien_dan',
        'loai_thao_luan',
        'background_image',
        'images',
        'ngay_tao',
        'ten_giang_vien'
    ];

    protected $casts = [
        'ngay_tao' => 'date'
    ];

    /**
     * Get the background image URL
     */
    public function getBackgroundImageUrlAttribute()
    {
        if (!$this->background_image) {
            return null;
        }
        return asset('storage/' . $this->background_image);
    }

    /**
     * Get valid attached images
     */
    public function getValidImagesAttribute()
    {
        if (empty($this->images)) {
            return [];
        }

        // Ensure images is decoded from JSON if it's a string
        $images = $this->images;
        if (is_string($images)) {
            $images = json_decode($images, true) ?? [];
        }

        // Ensure we always return an array
        return is_array($images) ? $images : [];
    }

    /**
     * Get URLs for valid attached images
     */
    public function getImageUrlsAttribute()
    {
        return array_map(function($image) {
            return asset('storage/' . $image);
        }, $this->valid_images);
    }

    /**
     * Set the images attribute
     */
    public function setImagesAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['images'] = json_encode($value);
        } else {
            $this->attributes['images'] = $value;
        }
    }

    // Define the hasMany relationship with DiendanMessage
    public function messages()
    {
        return $this->hasMany(DiendanMessage::class);
    }
}
