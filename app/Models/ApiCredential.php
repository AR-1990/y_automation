<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiCredential extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'provider',
        'api_key',
        'api_secret',
        'base_url',
        'additional_settings',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'api_key' => 'encrypted',
        'api_secret' => 'encrypted',
        'additional_settings' => 'array',
        'is_active' => 'boolean',
    ];
}
