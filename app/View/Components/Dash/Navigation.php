<?php

namespace App\View\Components\Dash;

use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class Navigation extends Component
{


    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dash.navigation');
    }
}
