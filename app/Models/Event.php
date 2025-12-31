<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizer_id',
        'category_id',
        'visibility_id',
        'judul',
        'description',
        'lokasi',
        'waktu_mulai',
        'waktu_selesai',
        'harga_tiket',
        'requires_approval',
        'kapasitas',
        'image',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
        'requires_approval' => 'boolean',
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function visibility()
    {
        return $this->belongsTo(EventVisibility::class, 'visibility_id');
    }

    public function images()
    {
        return $this->hasMany(EventImage::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function scopeVisible($query)
    {
        return $query->where(function ($q) {
            $q->whereHas('visibility', function ($sq) {
                $sq->where('slug', 'public');
            })->orWhere('organizer_id', auth()->id());
        });
    }
}
