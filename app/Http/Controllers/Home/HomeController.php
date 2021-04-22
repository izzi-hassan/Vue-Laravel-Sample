<?php

namespace App\Http\Controllers\Home;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(Request $request) {
        $page = Page::where('slug', 'micro-home')->first();

        $data = array(
            'pageData' => $page->withFakes(),
            'slug' => 'micro-home'
        );

        return view('pages.microsite.micro-home', $data);
    }
}
