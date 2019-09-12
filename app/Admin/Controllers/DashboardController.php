<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Show the main admin page
     *
     * @return \Illuminate\Http\Response
     */
    public function handle()
    {
        return view('admin.dashboard');
    }

}
