<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GetCarController extends Controller
{
    public function index(){
        return view('home.get_car');
    }
}
