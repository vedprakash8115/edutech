@extends('layout.app')

@section('content')
<div class="container py-4">
    <h1 class="display-4 mb-4">SEO Management</h1>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('seo.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New SEO Data
        </a>
        <div class="position-relative">
            <input type="text" id="search" placeholder="Search..." class="form-control" style="width: 250px;">
            <i class="fas fa-search position-absolute" style="right: 10px; top: 10px; color: #6c757d;"></i>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Target Page</th>
                            <th>Meta Title</th>
                            <th>Author</th>
                            <th>Open Graph Title</th>
                            <th>Open Graph Type</th>
                           
                            <th>Meta Keywords</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($seo as $item)
                        <tr>
                            <td>{{ $item->page_slug }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->author }}</td>
                            <td>{{ $item->og_title }}</td>
                            <td>{{ $item->og_description }}</td>
                            <td>{{ $item->meta_keywords }}</td>
               
                            <td class="text-center">
                                <a href="{{ route('seo.edit', $item->id) }}" class="text-warning me-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('seo.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Are you sure you want to delete this item?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<style>
    .btn-primary {
        transition: all 0.3s ease-in-out;
    }
    .btn-primary:hover {
        transform: scale(1.05);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // Search functionality
        const searchInput = document.getElementById('search');
        const tableRows = document.querySelectorAll('tbody tr');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    });
</script>
@endpush