<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'profile']);
    }

    public function loadApp(Request $request) {
        return view('layouts.app');
    }
}
