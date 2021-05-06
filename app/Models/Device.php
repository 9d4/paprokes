<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\BinaryOp\LogicalAnd;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'device_id', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function key() {
        return $this->hasOne(Key::class, 'device_id');
    }

    public function records() {
        return $this->hasMany(Record::class);
    }

    public function people() {
        return $this->hasMany(Person::class);
    }
}
