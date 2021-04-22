<?php

namespace App\Http\Controllers\Pages;

use App\Models\Page;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function __construct()
    {
    }

    public function showPage(Request $request, $slug) {
        if (substr($slug, 0, 3) == 'app')
            return view('layouts.app');

        $page = Page::findBySlug($slug);

        $data = array(
            'pageData' => $page->withFakes(),
            'slug' => $slug
        );

        return view('pages.microsite.'.$slug, $data);
    }
}
