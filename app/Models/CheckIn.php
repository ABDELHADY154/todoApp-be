<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckIn extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "country", "city", "long", "lat", "client_id"
    ];
    public function client()
    {
        return $this->belongsTo(Client::class, "client_id");
    }
}
