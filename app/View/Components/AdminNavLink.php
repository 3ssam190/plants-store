<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminNavLink extends Component
{
    public $href;
    public $icon;

    public function __construct($href, $icon)
    {
        $this->href = $href;
        $this->icon = $icon;
    }

    public function render()
    {
        return view('components.admin-nav-link');
    }
}