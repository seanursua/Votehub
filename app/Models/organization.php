<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class organization extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'orgName',
        'lname',
        'fname',
        'mname',
        'address',
        'email',
        'password',
        'NoS',
        'PoS',
        'Profile',
        'Status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

}
