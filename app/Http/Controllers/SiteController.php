<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function applicationForm()
    {
        return view('pages.site.application-form.index');
    }
}
