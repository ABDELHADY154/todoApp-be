<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["client_id", "desc", "summary", "due_date", "completed"];

    public function client()
    {
        return $this->belongsTo(Client::class, "client_id");
    }
}
