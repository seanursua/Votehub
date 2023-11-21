<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class electionDate extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'startdate',
        'enddate'
    ];
}
