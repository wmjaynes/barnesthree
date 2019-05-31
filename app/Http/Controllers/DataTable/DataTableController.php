<?php

namespace App\Http\Controllers\DataTable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Mockery\Exception;

abstract class DataTableController extends Controller
{

    protected $builder;
    protected $allowCreation = true;

    abstract public function builder();

    public function __construct()
    {
        $builder = $this->builder();

        if (!$builder instanceof Builder) {
            throw new Exception("Entity builder not instance of Builder");
        }

        $this->builder = $builder;
    }

    public function index(Request $request)
    {
        return response()->json([
            'data' => [
                'custom_sortby_columns' => $this->getCustomSortByColumnNames(),
                'custom_display_instead_of_columns' => $this->getCustomDisplayInsteadOfColumns(),
                'table' => $this->builder->getModel()->getTable(),
                'records' => $this->getRecords($request),
                'displayable' => array_values($this->getDisplayableColumns()),
                'updatable' => array_values($this->getUpdatableColumns()),
                'custom_columns' => $this->getCustomColumnNames(),
                'visible_columns' => $this->getVisibleColumns(),
                'allow' => [
                    'creation' => $this->allowCreation
                ],
                'columns_to_ignore_in_view' => $this->getColumnsToIgnoreInView(),
            ]
        ]);
    }

    public function store(Request $request)
    {
        if (!$this->allowCreation) {
            return;
        }

        $this->builder->create($request->only($this->getUpdatableColumns()));
    }

    public function update($id, Request $request)
    {
        $this->builder->find($id)->update($request->only($this->getUpdatableColumns()));
    }

    public function getDisplayableColumns()
    {
        return array_diff(
            $this->getDatabaseColumnNames(), $this->builder->getModel()->getHidden()
        );
    }

    public function getVisibleColumns() {
        return $this->getDisplayableColumns();
    }

    public function getColumnsToIgnoreInView() {
        return [];
    }

    public function getUpdatableColumns()
    {
        return array_intersect($this->getDatabaseColumnNames(), $this->getDisplayableColumns());
    }

    public function getCustomColumnNames() {
        return [];
    }

    public function getCustomSortByColumnNames() {
        return [];
    }

    public function getCustomDisplayInsteadOfColumns() {
        return [];
    }


    public function getDatabaseColumnNames()
    {

        return Schema::getColumnListing($this->builder->getModel()->getTable());

    }

    public function getRecords(Request $request) {
        $builder = $this->builder;

        if ($this->hasSearchQuery($request)) {
            $builder = $this->buildSearch($builder, $request);
        }

        try {
            return $builder->limit($request->limit)->orderBy('id', 'asc')->get($this->getDisplayableColumns());
        } catch (QueryException $e) {
            return [];
        }
    }

    protected function hasSearchQuery(Request $request)
    {
        return count(array_filter($request->only(['column', 'operator', 'value']))) === 3;
    }

    protected function buildSearch(Builder $builder, Request $request)
    {
        $queryParts = $this->resolveQueryParts($request->operator, $request->value);


        return $builder->where(
            $request->column,
            $queryParts['operator'],
            $queryParts['value']
        );
    }

    protected function resolveQueryParts($operator, $value)
    {
        return array_get([
            'equals' => [
                'operator' => '=',
                'value' => $value
            ],
            'contains' => [
                'operator' => 'LIKE',
                'value' => "%{$value}%"
            ],
            'starts_with' => [
                'operator' => 'LIKE',
                'value' => "{$value}%"
            ],
            'ends_with' => [
                'operator' => 'LIKE',
                'value' => "%{$value}"
            ],
            'greater_than' => [
                'operator' => '>',
                'value' => $value
            ],
            'less_than' => [
                'operator' => '<',
                'value' => $value
            ],
            'greater_than_or_equal_to' => [
                'operator' => '>=',
                'value' => $value
            ],
            'less_than_or_equal_to' => [
                'operator' => '<=',
                'value' => $value
            ],
        ], $operator);
    }

}
