<?php

declare(strict_types=1);

namespace Modules\Website\Controllers;

use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    // public function __construct(
    // ) {
    // }
    public function home()
    {
        return view('website::index');
    }

    public function privacy()
    {
        return view('website::privacy');
    }

    public function terms()
    {
        return view('website::terms');
    }
}
