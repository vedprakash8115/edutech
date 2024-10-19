@extends('layout.app')

@section('title', 'Admin Settings')

@push('styles')
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<style>
    .table-container {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
    }
    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .table thead th {
        background-color: #f8f9fa;
        color: #333;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 12px;
        border-bottom: 2px solid #dee2e6;
    }
    .table tbody td {
        padding: 12px;
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
    }
    .table tbody tr:nth-of-type(even) {
        background-color: #f8f9fa;
    }
    .table tbody tr:hover {
        background-color: #e9ecef;
    }
    .badge {
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 5px 10px;
        border-radius: 4px;
    }
    .badge-done {
        background-color: #dc3545;
        color: #fff;
    }
    .badge-planned {
        background-color: #ffc107;
        color: #212529;
    }
    .badge-todo {
        background-color: #17a2b8;
        color: #fff;
    }
    .badge-confirmed {
        background-color: #28a745;
        color: #fff;
    }
    .badge-offer {
        background-color: #6c757d;
        color: #fff;
    }
    .logo-preview {
        max-width: 50px;
        max-height: 50px;
        object-fit: contain;
    }
    .color-preview {
        width: 20px;
        height: 20px;
        display: inline-block;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .btn-group {
        display: flex;
        gap: 5px;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    .pagination {
        justify-content: center;
        margin-top: 20px;
    }
    @media (max-width: 768px) {
        .table-container {
            padding: 10px;
        }
        .table thead {
            display: none;
        }
        .table tbody td {
            display: block;
            text-align: right;
            padding-left: 50%;
            position: relative;
        }
        .table tbody td:before {
            content: attr(data-label);
            position: absolute;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            text-align: left;
            font-weight: bold;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h3 mb-0 text-white">Graphics Settings</h1>
                </div>
                <div class="card-body">
                    <div class="table-container">
                        <table class="table" id="settingsTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Logo</th>
                                    <th>Background</th>
                                    <th>Custom Text</th>
                                    <th>Text Size</th>
                                    <th>Text Color</th>
                                    <th>Condition</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($settings as $setting)
                                <tr>
                                    <td data-label="ID">{{ $setting->id }}</td>
                                    <td data-label="Logo">
                                        @if($setting->logo)
                                            <img src="{{ asset( $setting->logo) }}" alt="Logo" class="logo-preview">
                                        @else
                                            No Logo
                                        @endif
                                    </td>
                                    <td data-label="Background">
                                        <div class="color-preview" style="background-color: {{ $setting->background_color }};"></div>
                                        @if($setting->gradient_color_2)
                                            <div class="color-preview" style="background-color: {{ $setting->gradient_color_2 }};"></div>
                                        @endif
                                    </td>
                                    <td data-label="Custom Text">{{ $setting->custom_text ?? 'N/A' }}</td>
                                    <td data-label="Text Size"><span class="badge badge-info text-dark">{{ $setting->text_size }}</span></td>
                                    <td data-label="Text Color">
                                        <div class="color-preview" style="background-color: {{ $setting->text_color }};"></div>
                                    </td>
                                    <td data-label="Condition"><span class="badge badge-{{ strtolower($setting->condition) }} text-dark">{{ $setting->condition }}</span></td>
                                    <td data-label="Created At">{{ $setting->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td data-label="Actions">
                                        <div class="btn-group">
                                            <a href="{{ route('graphics.edit', $setting->id) }}" ><button type="submit" class="btn btn-sm btn-primary" >Edit</button></a>
                                            <form action="{{ route('graphics.destroy', $setting->id) }}" method="POST" >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this setting?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#settingsTable').DataTable({
            "pageLength": 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order": [[ 0, "desc" ]],
            "columnDefs": [
                { "orderable": false, "targets": [1, 2, 5, 8] }
            ],
            "responsive": true,
            "language": {
                "paginate": {
                    "previous": "&laquo;",
                    "next": "&raquo;"
                }
            }
        });
    });
</script>
@endpush