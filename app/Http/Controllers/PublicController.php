<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    //
    public function landingpage(){
        return view('public.landingpage');
    }
    public function info(){
        return view('public.info');
    }
}
