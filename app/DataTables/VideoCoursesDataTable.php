<?php

namespace App\DataTables;

use App\Models\VideoCourse;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VideoCoursesDataTable extends DataTable
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
                <a href="'.route('videocourse.edit', $row->id).'" class="btn btn-sm btn-primary my-2" style="width:100px;">Edit</a>
                
                <a href="'.route('folders.index', $row->id).'" class="btn btn-sm btn-secondary my-2" style="width:100px;">Add content</a>
                
               <a href="route(filemanager)" class="btn btn-sm btn-secondary my-2" onclick="addImage('.$row->id.')" style="width:100px;">Add content</a>
                
            ';
        })
        // <button class="btn btn-sm btn-danger my-2" onclick="deleteCourse('.$row->id.')">Delete</button>
        
            ->editColumn('banner', function ($row) {
                return '<img src="' . asset($row->banner) . '" class="img img-rounded" style="max-width: 100px; max-height: 100px;">';
            })
            ->editColumn('original_price', function ($row) {
                return number_format($row->original_price, 2);
            })
            ->editColumn('discount_price', function ($row) {
                return number_format($row->discount_price, 2);
            })
            ->rawColumns(['action', 'banner'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(VideoCourse $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('videocourses-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                 "<'row'<'col-sm-12'tr>>" .
                 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>")
            ->orderBy(1, 'asc')
            ->lengthMenu([[10, 25, 50, -1], [10, 25, 50, 'All']])
            ->pageLength(10)
            ->buttons([
                Button::make('create')->addClass('btn-success')->text('<i class="fa fa-plus"></i> Add New Course'),
                Button::make('export')->addClass('btn-info')->text('<i class="fa fa-download"></i> Export'),
                Button::make('print')->addClass('btn-primary')->text('<i class="fa fa-print"></i> Print'),
                Button::make('reset')->addClass('btn-danger')->text('<i class="fa fa-undo"></i> Reset'),
                Button::make('reload')->addClass('btn-warning')->text('<i class="fa fa-refresh"></i> Reload')
            ])
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,
                'language' => [
                    'search' => '_INPUT_',
                    'searchPlaceholder' => 'Search...',
                    'lengthMenu' => '<span class="d-none d-sm-inline">Show</span> _MENU_ entries',
                    'paginate' => [
                        'previous' => '<i class="fa fa-angle-left" style="color: #007bff;"></i>',
                        'next' => '<i class="fa fa-angle-right" style="color: #007bff;"></i>'
                    ],
                ],
                'drawCallback' => 'function() { $("[data-toggle=tooltip]").tooltip(); }',
                'initComplete' => "function() {
                    $('.dataTables_filter input').addClass('form-control');
                    $('.dataTables_length select').addClass('form-control');
                    
                    // Add JavaScript function for video upload
                    window.uploadVideos = function(courseId, files) {
                        var formData = new FormData();
                        formData.append('course_id', courseId);
                        for (var i = 0; i < files.length; i++) {
                            formData.append('videos[]', files[i]);
                        }
                        
                        $.ajax({
                            url: '".route('videocourse.uploadVideos')."',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')
                            },
                            success: function(response) {
                                alert('Videos uploaded successfully!');
                                // Optionally refresh the table
                                $('#videocourses-table').DataTable().ajax.reload();
                            },
                            error: function(xhr, status, error) {
                                alert('Error uploading videos: ' + error);
                            }
                        });
                    }
                }",
            ]);
    }


    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID')->width('50px'),
            Column::make('course_name')->title('Course Name'),
            Column::make('language')->title('Language'),
            Column::make('is_paid')->title('Paid'),
            Column::make('price')->title('Original Price'),
            Column::make('discount_price')->title('Discount Price'),
            Column::make('course_duration')->title('Duration (Days)'),
            // Column::make('banner')->title('Course Banner'),
            // Column::make('course_category_id')->title('Category'),
            Column::make('from')->title('Start Date'),
            Column::make('to')->title('End Date'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width('150px')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VideoCourses_' . date('YmdHis');
    }
}