<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminBaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        
        // Share common data to all admin views
        view()->composer('admin.*', function ($view) {
            $view->with('currentAdmin', Auth::user());
        });
    }
}