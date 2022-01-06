<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashboardLayout extends Component
{

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('layouts.dashboard');
    }
}
