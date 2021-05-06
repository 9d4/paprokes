<?php

namespace App\Services;

class NavService
{
    public function __construct()
    {
        $uri = request()->url();

        $this->dash_active = $uri == route('index');
    }
}