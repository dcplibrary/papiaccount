<?php

namespace Dcplibrary\PAPIAccount\App\Http\Controllers;

use App\Http\Controllers\Controller;

class PatronLogoutController extends Controller
{
    public function __invoke()
    {
        session()->flush();

        return redirect('/');
    }
}
