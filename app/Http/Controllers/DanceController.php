<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;

class DanceController extends Controller
{
    public function index()
    {
        return view('dances');
    }
}
