<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class voter extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'section',
        'representative',
        'gender',
        'bday',
        'voterID',
        'voterKey',
        'email',
        'mobileNo',
        'img',
        'status',
        'token'
    ];


    protected $hidden = [
        'voterKey',
    ];
}
