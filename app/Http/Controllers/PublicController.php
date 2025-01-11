<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    //
    public function landingpage(){
        return view('public.landingpage');
    }
    public function info(){
        $penyakit = Penyakit::all();
        return view('public.info', compact('penyakit'));
    }
    
    public function alursistem(){
        return view('public.alurSistem');
    }
}
