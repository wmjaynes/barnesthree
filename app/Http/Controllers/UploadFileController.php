<?php

namespace App\Http\Controllers;

use App\DanceTableHelper;
use function fopen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use CreateDancesTable;

class UploadFileController extends Controller
{
    public function index()
    {
        return view('uploadfile');
    }

    public function showUploadFile(Request $request)
    {
        $file = $request->file('image');

        //Display File Name
        echo 'File Name: ' . $file->getClientOriginalName();
        echo '<br>';

        //Display File Extension
        echo 'File Extension: ' . $file->getClientOriginalExtension();
        echo '<br>';

        //Display File Real Path
        echo 'File Real Path: ' . $file->getRealPath();
        echo '<br>';

        //Display File Size
        echo 'File Size: ' . $file->getSize();
        echo '<br>';

        //Display File Mime Type
        echo 'File Mime Type: ' . $file->getMimeType();

        //Move Uploaded File
        $destinationPath = 'uploads';
        $file->move($destinationPath, $file->getClientOriginalName());


        $myfile = fopen($destinationPath . '/' . $file->getClientOriginalName(), "r");

        $i = 0;
        while (!feof($myfile)) {
            $table[$i] = fgetcsv($myfile);
            $i++;
        }

        $this->recreateTable();

        DanceTableHelper::loadDancesTable($table);


    }

    protected function recreateTable()
    {
        Schema::dropIfExists('dances');

        Schema::create('dances', function (Blueprint $table){
            DanceTableHelper::createTable($table);
        });
    }
}