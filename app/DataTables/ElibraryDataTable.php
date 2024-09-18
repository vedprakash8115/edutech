<?php

namespace App\DataTables;

use App\Models\Elibrary;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ElibraryDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                return '
                    <a href="'.route('elibrary.edit', $row->id).'" class="btn btn-sm btn-primary my-2" style="width:100px;">Edit</a>
                    <a href="'.route('elibrary.files', $row->id).'" class="btn btn-sm btn-info my-2" style="width:100px;">View Files</a>
                ';
            })
            ->editColumn('banner', function ($row) {
                return '<img src="' . asset($row->banner) . '" class="img img-rounded" style="max-width: 100px; max-height: 100px;">';
            })
            ->rawColumns(['action', 'banner'])
            ->setRowId('id');
    }

    public function query(Elibrary $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('elibrary-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                 "<'row'<'col-sm-12'tr>>" .
                 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>")
            ->orderBy(1, 'asc')
            ->lengthMenu([[10, 25, 50, -1], [10, 25, 50, 'All']])
            ->pageLength(10)
            ->buttons([
                Button::make('create')->addClass('btn-success')->text('<i class="fa fa-plus"></i> Add New Item'),
                Button::make('export')->addClass('btn-info')->text('<i class="fa fa-download"></i> Export'),
                Button::make('print')->addClass('btn-primary')->text('<i class="fa fa-print"></i> Print'),
                Button::make('reset')->addClass('btn-danger')->text('<i class="fa fa-undo"></i> Reset'),
                Button::make('reload')->addClass('btn-warning')->text('<i class="fa fa-refresh"></i> Reload')
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width('50px'),
            Column::make('title')->title('Title'),
            Column::make('cat_level_0')->title('Category'),
            // Column::make('cat_level_1')->title('Category Level 1'),
            // Column::make('cat_level_2')->title('Category Level 2'),
            Column::make('is_paid')->title('Is Paid'),
            Column::make('price')->title('Price'),
            Column::make('discount_price')->title('Discount Price'),
            Column::make('banner')->title('Banner'),
            // Column::make('file')->title('File'),
            Column::make('description')->title('Description'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width('150px')
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Elibrary_' . date('YmdHis');
    }
}
