<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

const ADMIN_ROLE = 'admin';
const USER_ROLE = 'user';

trait AdminTrait
{
    public static function user()
    {
        return Auth::user();
    }
}