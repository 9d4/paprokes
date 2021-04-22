<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait AdminTrait
{
    public static function user()
    {
        return Auth::user();
    }
}