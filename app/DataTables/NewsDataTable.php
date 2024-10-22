<?php

namespace App\DataTables;

namespace App\DataTables;

use App\Models\News;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class NewsDataTable extends DataTable
{
    public function dataTable($query)
{
    return datatables()
        ->eloquent($query)
        ->addColumn('action', function ($news) {
            return '<a href="'.route('news.edit', $news->id).'" class="btn btn-sm btn-primary">Edit</a>
                    <form action="'.route('news.destroy', $news->id).'" method="POST" style="display:inline-block;">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>
                    </form>';
        })
        ->editColumn('image', function ($news) {
            return $news->image ? '<img src="'.asset('storage/' . $news->image).'" width="50" height="50">' : 'No Image';
        })
        ->rawColumns(['action', 'image']);
}


    public function query(News $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('news-table')
            ->columns($this->getColumns())
            ->minifiedAjax();
    }

    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('title'),
            Column::make('description'),
            Column::make('date'),
            Column::make('status')->title('Status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    protected function filename():string
    {
        return 'News_' . date('YmdHis');
    }
}
