<?php

namespace App\DataTables;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BookDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                return '
                    <a href="'.route('books.edit', $row->id).'" class="btn btn-sm btn-primary my-2" style="width:100px;">Edit</a>
                       <form action="'.route('books.destroy', $row->id).'" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure you want to delete this?\');">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger my-2" style="width:100px;">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                    </form>
                ';
            })
            ->setRowId('id');
    }
    /**
     * Get the query source of dataTable.
     */
    public function query(Book $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('books-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                 "<'row'<'col-sm-12'tr>>" .
                 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>")
            ->orderBy(1, 'asc')
            ->lengthMenu([[10, 25, 50, -1], [10, 25, 50, 'All']])
            ->pageLength(10)
            ->buttons([
                Button::make('create')->addClass('btn-success')->text('Add New Book'),
                Button::make('export')->addClass('btn-info')->text('Export'),
                Button::make('print')->addClass('btn-primary')->text('Print'),
                Button::make('reset')->addClass('btn-danger')->text('Reset'),
                Button::make('reload')->addClass('btn-warning')->text('Reload')
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width('50px'),
            Column::make('title')->title('Title'),
            Column::make('author')->title('Author'),
        
            Column::make('isbn')->title('ISBN'),
            Column::make('price')->title('Price'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width('120px')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Book_' . date('YmdHis');
    }
}
