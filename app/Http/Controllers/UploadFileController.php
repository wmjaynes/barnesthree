<?php

namespace App\Http\Controllers;

use App\DanceTableHelper;
use function fopen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use CreateDancesTable;
use function view;

class UploadFileController extends Controller
{
    public function index()
    {
        return view('uploadfile');
    }

    public function showUploadFile(Request $request)
    {
        $file = $request->file('image');

        $fileName = $file->getClientOriginalName();
        $fileExtension =  $file->getClientOriginalExtension();
        $fileRealPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $fileMimeType = $file->getMimeType();

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

        return view('uploadfile',
            [
                'fileName' => $fileName,
                'fileExtension' => $fileExtension,
                'fileRealPath' => $fileRealPath,
                'fileSize' => $fileSize,
                'fileMimeType' => $fileMimeType
            ]);


    }

    protected function recreateTable()
    {
        Schema::dropIfExists('dances');

        Schema::create('dances', function (Blueprint $table) {
            DanceTableHelper::createTable($table);
        });
    }
}
