<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait AdminTrait
{
    public static $ADMIN_ROLE = 'admin';
    public static $USER_ROLE = 'user';

    public static function user()
    {
        return Auth::user();
    }
}