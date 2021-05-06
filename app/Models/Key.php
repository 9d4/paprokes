<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    use HasFactory;

    protected $fillable = ['api_key', 'device_id'];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
