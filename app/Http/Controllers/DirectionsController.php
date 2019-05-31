<?php

namespace App\Http\Controllers;

use function explode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function preg_replace_array;
use function strpos;

class DirectionsController extends Controller
{
    public function show($name)
    {
        if (strpos($name, '/') !== false) {
            $names = explode('/', $name);
            $name = $names[0];
        }
        $filename = preg_replace("/^(The |A |An )/", "", ucwords($name));
        $filename = preg_replace("/[^a-zA-Z0-9]/", "", $filename);

        $filename = "/" . $filename . "/" . $filename . ".pdf";

//        $exists = Storage::disk()->exists($filename);

        $fname = Storage::disk()->getDriver()->getAdapter()->applyPathPrefix($filename);

//        dd($fname);

        return response()->file($fname);
    }
}
