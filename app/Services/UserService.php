<?php

namespace App\Services;

use Illuminate\Support\Facades\Request;

class UserService
{
    public function current()
    {
        return Request::user();
    }
}