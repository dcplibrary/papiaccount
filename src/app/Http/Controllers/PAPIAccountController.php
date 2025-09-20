<?php

namespace Dcplibrary\PAPIAccount\App\Http\Controllers;

use Illuminate\Routing\Controller;

class PAPIAccountController extends Controller
{
    /**
     * Display the PAPIAccount index page.
     */
    public function index()
    {
        return view('papiaccount::index');
    }
}
