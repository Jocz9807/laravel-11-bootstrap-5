<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ic_number',
        'vote',
        'voted_at',
    ];

    /**
     * Cast attributes to specific types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'voted_at' => 'datetime',
    ];
}
