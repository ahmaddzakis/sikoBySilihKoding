<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventVisibility extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'slug'];

    public function events()
    {
        return $this->hasMany(Event::class, 'visibility_id');
    }
}
