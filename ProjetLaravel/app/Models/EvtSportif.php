<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use User;

class EvtSportif extends Model
{
    /** @use HasFactory<\Database\Factories\EvtSportifFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'date',
        'category',
        'max_participants'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'inscription_evt');
    }
}
