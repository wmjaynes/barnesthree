<?php

namespace App\Http\Controllers;

use function explode;
use function file_exists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function preg_replace;
use function preg_replace_array;
use function strpos;
use function view;

class DirectionsController extends Controller
{
    public function show($name)
    {
        $filename = $name;
        if (strpos($name, '/') !== false) {
            $names = explode('/', $name);
            $filename = $names[0];
        }

        $filename = "/" . $filename . "/" . $filename . ".pdf";

//        $exists = Storage::disk()->exists($filename);

        $fname = Storage::disk()->getDriver()->getAdapter()->applyPathPrefix($filename);

        if (! file_exists($fname))
            return view('errors.missing-directions');

//        dd($fname);

        return response()->file($fname);
    }
}
