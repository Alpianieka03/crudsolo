<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Boot method for the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $validator = Validator::make($model->attributesToArray(), [
                'role' => 'required|in:admin,user',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
        });

        static::updating(function ($model) {
            $validator = Validator::make($model->attributesToArray(), [
                'role' => 'required|in:admin,user',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
        });
    }
}
