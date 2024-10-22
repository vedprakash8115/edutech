<?php

namespace App\DataTables;

use App\Models\liveClass;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class liveClassesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
{
    return (new EloquentDataTable($query))
        ->addColumn('actions', function ($row) {
            $editUrl = route('liveClasses.edit', $row->id);
            $deleteUrl = route('liveClasses.destroy', $row->id);
            $pdfUrl = route('live-class-pdfs.index', $row->id);

            // Button to open the schedule modal
            $scheduleBtn = '
                <button type="button" class="btn btn-sm btn-success my-2" style="width:120px;" 
                    data-bs-toggle="modal" data-bs-target="#scheduleModal" 
                    data-class-id="' . e($row->id) . '">
                    <i class="fas fa-calendar-alt"></i> Schedule
                </button>';

            return '
                ' . $scheduleBtn . ' 
                <a href="' . e($editUrl) . '" class="btn btn-sm btn-info my-2" style="width:100px;">
                    <i class="fa fa-pencil"></i> Edit
                </a>
                <a href="' . e($pdfUrl) . '" class="btn btn-sm btn-dark my-2" style="width:130px;">
                    <i class="fas fa-file-pdf mr-2"></i> Manage PDFs
                </a>
                <form action="' . e($deleteUrl) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure you want to delete this?\');">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-sm btn-danger my-2" style="width:100px;">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </form>
            ';
        })
        ->setRowId('id')
        ->rawColumns(['actions']);
}

    

    

    /**
     * Get the query source of dataTable.
     */
    public function query(liveClass $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('liveclasses-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->responsive(true)
            ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                 "<'row'<'col-sm-12'tr>>" .
                 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>")
            ->orderBy(1, 'asc')
            ->lengthMenu([[10, 25, 50, -1], [10, 25, 50, 'All']])
            ->pageLength(10)
            ->language([
                'lengthMenu' => '_MENU_ records per page',
                'zeroRecords' => 'No matching records found',
                'info' => 'Showing _START_ to _END_ of _TOTAL_ records',
                'infoEmpty' => 'No records available',
                'infoFiltered' => '(filtered from _MAX_ total records)',
                'search' => 'Search:',
                'paginate' => [
                    'first' => '<i class="fa fa-angle-double-left" style="color: #007bff;"></i>',
                    'previous' => '<i class="fa fa-angle-left" style="color: #007bff;"></i>',
                    'next' => '<i class="fa fa-angle-right" style="color: #007bff;"></i>',
                    'last' => '<i class="fa fa-angle-double-right" style="color: #007bff;"></i>'
                ],
            ])
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel')->addClass('btn-success')->text('<i class="fa fa-file-excel-o"></i> Excel'),
                Button::make('csv')->addClass('btn-info')->text('<i class="fa fa-file-text-o"></i> CSV'),
                Button::make('pdf')->addClass('btn-danger')->text('<i class="fa fa-file-pdf-o"></i> PDF'),
                Button::make('print')->addClass('btn-primary')->text('<i class="fa fa-print"></i> Print'),
                Button::make('reset')->addClass('btn-warning')->text('<i class="fa fa-undo"></i> Reset'),
                Button::make('reload')->addClass('btn-default')->text('<i class="fa fa-refresh"></i> Reload')
            ])
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,
                'drawCallback' => 'function() { $("[data-toggle=tooltip]").tooltip(); }',
                'initComplete' => "function() {
                    $('.dataTables_filter input').addClass('form-control').attr('placeholder', 'Search...');
                    $('.dataTables_length select').addClass('form-control');
                }",
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            
    
            Column::make('id')->title('Sr. No.'), // Serial number
            Column::make('course_name')->title('Course Name'), // Course name
            Column::make('language')->title('Language'), // Language
          // Discount type
            Column::make('is_paid')->title('Paid'),
            // Column::make('discount_type')->title('Discount Type'), // Discount type
            Column::make('discount_price')->title('Discount Price'), // Discount price
            Column::make('price')->title('Original Price'), // Original price
            Column::make('course_duration')->title('Course Duration'), // Course duration
            Column::make('from')->title('Start Date'), // Start date
            // Column::make('to')->title('To'), // End date
          
            Column::computed('actions') // Actions for edit/delete buttons
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }
    

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'liveClasses_' . date('YmdHis');
    }
}
