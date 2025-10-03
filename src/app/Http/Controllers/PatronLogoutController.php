<?php

namespace Dcplibrary\PAPIAccount\App\Http\Controllers;

use Illuminate\Routing\Controller;

class PatronLogoutController extends Controller
{
    public function __invoke()
    {
        session()->flush();

        return redirect('/');
    }
}
