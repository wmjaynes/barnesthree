<?php
/**
 * Created by PhpStorm.
 * User: jaynes
 * Date: 2/6/2018
 * Time: 1:38 PM
 */

namespace App;


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class DanceTableHelper
{
    public static function createTable(Blueprint $table)
    {
        $table->increments('id');
        $table->string('status');
        $table->string('title_sort');
        $table->string('title');
        $table->string('chor_pub_sort');
        $table->string('chor_pub');
        $table->string('reconstruction')->nullable();
        $table->string('source')->nullable();
        $table->string('source_url')->nullable();
        $table->string('date')->nullable();
        $table->string('comment')->nullable();
        $table->string('tune_sort')->nullable();
        $table->string('tune')->nullable();
        $table->string('composer_sort')->nullable();
        $table->string('composer')->nullable();
        $table->string('tune_source')->nullable();
        $table->string('tune_date')->nullable();
        $table->string('dance_form')->nullable();
        $table->string('meter')->nullable();
        $table->string('tempo')->nullable();
        $table->string('key')->nullable();
        $table->string('tune_form')->nullable();
        $table->string('page')->nullable();
        $table->string('difficulty')->nullable();
        $table->string('energy')->nullable();

        $table->timestamps();
    }

    public static function loadDancesTable($table)
    {
        array_shift($table);    // remove titles

        foreach ($table as $row) {
            if (empty($row[0])) {
                break;
            }

            DB::table('dances')->insert([
                'status' => $row[0],
                'title_sort' => $row[1],
                'title' => $row[2],
                'chor_pub_sort' => $row[3],
                'chor_pub' => $row[4],
                'reconstruction' => $row[5],
                'source' => $row[6],
                'source_url' => $row[7],
                'date' => $row[8],
                'comment' => $row[9],
                'tune_sort' => $row[10],
                'tune' => $row[11],
                'composer_sort' => $row[12],
                'composer' => $row[13],
                'tune_source' => $row[14],
                'tune_date' => $row[15],
                'dance_form' => $row[16],
                'meter' => $row[17],
                'tempo' => $row[18],
                'key' => $row[19],
                'tune_form' => $row[20],
                'page' => $row[21],
                'difficulty' => $row[22],
                'energy' => $row[23],
            ]);
        }
    }


}