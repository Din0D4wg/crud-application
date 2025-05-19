<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory; 

    protected $fillable = [
        'firstname', 'lastname', 'username', 'email', 'phone', 'password', 'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
