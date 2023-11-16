<?php

namespace Nurdaulet\FluxBase\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image',
        'logo',
        'logo_webp',
        'webp',
        'lft',
        'is_active'
    ];
    protected $appends = [
        'image_url', 'webp_url',
        'logo_url', 'logo_webp_url',
        ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function partner()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function cities()
    {
        return $this->belongsToMany(City::class, 'partner_cities',
            'partner_id', 'city_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active',1);
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? config('filesystems.disks.s3.url') . '/' . $this->image : null;
    }

    public function getWebpUrlAttribute()
    {
        return $this->webp ? config('filesystems.disks.s3.url') . '/' . $this->webp : null;
    }

    public function getLogoUrlAttribute()
    {
        return $this->logo ? config('filesystems.disks.s3.url') . '/' . $this->logo : null;
    }

    public function getLogoWebpUrlAttribute()
    {
        return $this->logo_webp ?  config('filesystems.disks.s3.url').'/'.$this->logo_webp : null;
    }
}
