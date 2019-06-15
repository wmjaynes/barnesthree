<?php

namespace App\Http\Controllers\DataTable;

use App\Dance;
use App\Http\Controllers\DataTable\DataTableController;
use App\Plan;
use function explode;
use Illuminate\Http\Request;
use function implode;
use function preg_replace;
use function sizeof;
use function strpos;

class DanceController extends DataTableController
{
    public function builder()
    {
        return Dance::query();
    }

    public function getRecords(Request $request)
    {
        $records = parent::getRecords($request);
        foreach ($records as $record) {

            $titles = explode('/', $record->title);
            $titlesStr = implode('<br>', $titles);
            $titleLink = $record->title_sort;
            $titleLink = preg_replace("/[^a-zA-Z0-9]/", "", $titleLink);

            if (strpos($record->status, "approved") === 0) {

                $route = route('directions', ['name' => $titleLink]);

//                $link = "<a target='_blank' href='" . $titles[0] . "'>" . $titlesStr . "</a>";
                $link = "<a target='_blank' href='$route'>$titlesStr</a>";
                $record->directions_link = $link;
            }
            $record->title = $titlesStr;

            $tunes = explode('/', $record->tune);
            $tunesStr = implode('<br>', $tunes);
            $record->tune = $tunesStr;

//            if (strpos($record->source, "http") !== false) {
//                $record->source = "<a target='_blank' href='$record->source'>Link to Source</a>";
//            }

            if (!empty($record->source) && !empty($record->source_url)) {
                $record->source_link = "<a target='_blank' href='$record->source_url'>$record->source</a>";
            }
        }
        return $records;
    }

    public function getDisplayableColumns()
    {
        return ['status',
            'title_sort', 'title', 'chor_pub_sort', 'chor_pub',  'date','reconstruction', 'source', 'source_url',
            'dance_form','tune_sort', 'tune', 'composer_sort', 'composer',  'meter', 'key',
            'tune_form', 'comment', 'page', 'difficulty', 'energy'
        ];
    }

    public function getVisibleColumns()
    {
        return [
            'title', 'chor_pub', 'source',
            'tune', 'composer',
        ];
    }

    public function getColumnsToIgnoreInView()
    {
        return ['status', 'source_url'];
    }

    public function getCustomDisplayInsteadOfColumns()
    {
        return [
            'title' => 'directions_link',
            'source' => 'source_link',
        ];
    }

    public function getCustomSortByColumnNames()
    {
        return [
            'title' => 'title_sort',
            'chor_pub' => 'chor_pub_sort',
            'tune' => 'tune_sort',
            'composer' => 'composer_sort',
        ];
    }

    public function getCustomColumnNames()
    {
        return [
            'title' => 'Title',
            'chor_pub' => 'Choreographer/<br>Publisher',
            'date' => 'Date',
            'tune' => 'Tune',
            'dance_form' => 'Formation',
            'key' => 'Key',
            'composer' => 'Composer/<br>Publisher',
            'tune_form' => 'Tune Form',
            'Meter' => 'Meter',
            'source' => 'Source',
            'comment' => 'Comment',
            'meter' => 'Meter',
            'reconstruction' => 'Reconstructor',
            'difficulty'=> 'Difficulty',
            'energy' => 'Energy',
            'page' => 'Page',
        ];
    }


//    public function store(Request $request)
//    {
//        $this->validate($request, [
//            'braintree_id' => 'required',
//            'price' => 'required',
//        ]);
//
//        if (!$this->allowCreation) {
//            return;
//        }
//
//        $this->builder->create($request->only($this->getUpdatableColumns()));
//    }
}
