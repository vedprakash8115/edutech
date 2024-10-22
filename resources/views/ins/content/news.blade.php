@extends('layout.app')

@section('content')
<style>
        .form-container {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-top: 2rem;
        }
        
        .form-title {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e9ecef;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 0.75rem;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(44, 62, 80, 0.15);
            border-color: #2c3e50;
        }
        
        .btn-submit {
            padding: 0.75rem 2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .table-container {
            margin-top: 3rem;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 1.5rem;
        }
        
        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
        }
        
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
        }
        
        .status-active {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
<!-- news_form.blade.php -->
<div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="form-container">
                    <h3 class="form-title">
                        <i class="lucide-newspaper me-2"></i>
                        {{ isset($news) ? 'Edit News' : 'Add News' }}
                    </h3>
                    
                    <form action="{{ isset($editNews) ? route('news.update', $editNews->id) : route('news.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($editNews))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label class="form-label" for="title">
                                <i class="lucide-type me-1"></i>Title
                            </label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ isset($editNews) ? $editNews->title : '' }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="description">
                                <i class="lucide-file-text me-1"></i>Description
                            </label>
                            <textarea name="description" id="description" class="form-control" rows="4"
                                required>{{ isset($editNews) ? $editNews->description : '' }}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="date">
                                <i class="lucide-calendar me-1"></i>Date
                            </label>
                            <input type="date" name="date" id="date" class="form-control"
                                value="{{ isset($editNews) ? $editNews->date->format('Y-m-d') : '' }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="image">
                                <i class="lucide-image me-1"></i>Image
                            </label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="status">
                                <i class="lucide-toggle-left me-1"></i>Status
                            </label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1" {{ isset($editNews) && $editNews->status ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ isset($editNews) && !$editNews->status ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-submit">
                            <i class="lucide-save me-2"></i>
                            {{ isset($editNews) ? 'Update News' : 'Add News' }}
                        </button>
                    </form>
                </div>

            </div>


            <div class="col-md-6 mx-auto">
                

                <div class="table-container">
                    <div class="card-body">
                        <div class="table-responsive dataTables_wrapper" id="dataTables_wrapper">
                            {{ $dataTable->table(['class' => 'table table-hover']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

</div>
@endsection
