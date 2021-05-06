<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['rfid', 'name', 'device_id'];

    public function device() {
        return $this->belongsTo(Device::class);
    }
}
