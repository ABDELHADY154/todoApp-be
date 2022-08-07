<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens, Notifiable;

    protected $fillable = [
        "name", "email", "password", "last_updated"
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function checkIns()
    {
        return $this->hasMany(CheckIn::class);
    }
}
