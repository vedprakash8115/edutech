@extends('layout.app')

@section('content')
<div class="container-fluid live-class-pdfs-container">
    <div class="live-class-pdfs-header mb-5">
        <h1 class="live-class-pdfs-title">Live Class PDFs</h1>
        <p class="live-class-pdfs-subtitle">Manage Your Live Class PDF Resources</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('live-class-pdfs.deleteMultiple') }}" method="POST" id="multipleDeleteForm">
        @csrf
        @method('DELETE')
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <div class="d-flex flex-wrap align-items-center mb-3 mb-md-0">
                <button type="submit" class="btn btn-danger mb-2 mb-md-0 me-2" id="deleteSelected" disabled>
                    <i class="fas fa-trash-alt"></i> Delete Selected
                </button>
                <div class="btn-group mb-2 mb-md-0 me-2" role="group" aria-label="View toggle">
                    <button type="button" class="btn btn-outline-primary active" id="tileView">
                        <i class="fas fa-th-large"></i> Tile
                    </button>
                    <button type="button" class="btn btn-outline-primary" id="tableView">
                        <i class="fas fa-list"></i> Table
                    </button>
                </div>
                <button type="button" class="btn btn-primary mb-2 mb-md-0 me-2" data-bs-toggle="modal" data-bs-target="#addPdfModal">
                    <i class="fas fa-plus"></i> Add PDF
                </button>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="selectAll">
                <label class="form-check-label" for="selectAll">Select All</label>
            </div>
        </div>

        <div id="tileViewContainer" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">
            @foreach($pdfs as $pdf)
                <div class="col" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="pdf-card h-100">
                        <div class="pdf-card-header">
                            <h5 class="pdf-title">{{ Str::limit($pdf->pdf_path, 20) }}</h5>
                            <div class="form-check">
                                <input class="form-check-input pdf-select" type="checkbox" name="pdf_ids[]" value="{{ $pdf->id }}">
                            </div>
                        </div>
                        <div class="pdf-card-body">
                            <div class="pdf-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <p class="pdf-description">{{ Str::limit($pdf->pdf_path, 80) }}</p>
                        </div>
                        <div class="pdf-card-footer">
                            <a href="{{ asset($pdf->pdf_path) }}" target="_blank" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-external-link-alt"></i> Open
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="tableViewContainer" class="table-responsive" style="display: none;">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pdfs as $pdf)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input pdf-select" type="checkbox" name="pdf_ids[]" value="{{ $pdf->id }}">
                                </div>
                            </td>
                            <td>{{ Str::limit($pdf->pdf_path, 30) }}</td>
                            <td>
                                <a href="{{ asset($pdf->pdf_path) }}" target="_blank" class="btn btn-primary btn-sm w-100">
                                    <i class="fas fa-external-link-alt"></i> Open
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>
</div>

<!-- Add PDF Modal -->
<div class="modal fade" id="addPdfModal" tabindex="-1" aria-labelledby="addPdfModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPdfModalLabel">Add New PDF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('live-class-pdfs.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">PDF Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="pdf_file" class="form-label">PDF File</label>
                        <input type="file" class="form-control" id="pdf_file" name="pdf_file" accept=".pdf" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload PDF</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');

    :root {
        --primary-color: #4e54c8;
        --secondary-color: #8f94fb;
        --background-color: #f4f7f6;
        --card-background: #ffffff;
        --text-color: #2c3e50;
        --border-radius: 8px;
        --transition: all 0.3s ease;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--background-color);
        color: var(--text-color);
    }

    .live-class-pdfs-container {
        padding: 3rem 1rem;
    }

    .live-class-pdfs-header {
        text-align: center;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        padding: 4rem 2rem;
        border-radius: var(--border-radius);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 3rem;
    }

    .live-class-pdfs-title {
        color: #fff;
        font-weight: 700;
        font-size: 3.5rem;
        margin-bottom: 0.5rem;
        letter-spacing: -1px;
    }

    .live-class-pdfs-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.3rem;
        font-weight: 300;
    }

    .pdf-card {
        background-color: var(--card-background);
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .pdf-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
    }

    .pdf-card-header {
        padding: 1.5rem;
        background-color: rgba(0, 0, 0, 0.03);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .pdf-title {
        margin: 0;
        font-weight: 600;
        color: var(--text-color);
        font-size: 1rem;
        word-break: break-word;
    }

    .pdf-card-body {
        padding: 1.5rem;
        text-align: center;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .pdf-icon {
        font-size: 3.5rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .pdf-description {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .pdf-card-footer {
        padding: 1rem 1.5rem;
        background-color: rgba(0, 0, 0, 0.03);
        text-align: center;
    }

    .btn {
        transition: var(--transition);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
    }

    .table {
        background-color: var(--card-background);
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .table th {
        background-color: rgba(0, 0, 0, 0.03);
        font-weight: 600;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    @media (max-width: 768px) {
        .live-class-pdfs-title {
            font-size: 2.5rem;
        }
        .live-class-pdfs-subtitle {
            font-size: 1.1rem;
        }
        .pdf-card-header, .pdf-card-body, .pdf-card-footer {
            padding: 1rem;
        }
        .pdf-icon {
            font-size: 2.5rem;
        }
    }

    @media (min-width: 2000px) {
        .container-fluid {
            max-width: 1920px;
            margin: 0 auto;
        }
        .live-class-pdfs-title {
            font-size: 4.5rem;
        }
        .live-class-pdfs-subtitle {
            font-size: 1.8rem;
        }
        .pdf-card {
            min-height: 300px;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            once: true,
            duration: 800,
            offset: 100,
        });

        const selectAll = document.getElementById('selectAll');
        const pdfCheckboxes = document.querySelectorAll('.pdf-select');
        const deleteSelectedBtn = document.getElementById('deleteSelected');
        const tileViewBtn = document.getElementById('tileView');
        const tableViewBtn = document.getElementById('tableView');
        const tileViewContainer = document.getElementById('tileViewContainer');
        const tableViewContainer = document.getElementById('tableViewContainer');

        selectAll.addEventListener('change', function() {
            pdfCheckboxes.forEach(checkbox => checkbox.checked = this.checked);
            updateDeleteButton();
        });

        pdfCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateDeleteButton);
        });

        function updateDeleteButton() {
            const checkedBoxes = document.querySelectorAll('.pdf-select:checked');
            deleteSelectedBtn.disabled = checkedBoxes.length === 0;
        }

        tileViewBtn.addEventListener('click', function() {
            tileViewContainer.style.display = 'flex';
            tableViewContainer.style.display = 'none';
            tileViewBtn.classList.add('active');
            tableViewBtn.classList.remove('active');
        });

        tableViewBtn.addEventListener('click', function() {
            tileViewContainer.style.display = 'none';
            tableViewContainer.style.display = 'block';
            tableViewBtn.classList.add('active');
            tileViewBtn.classList.remove('active');
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('selectAll');
        const pdfCheckboxes = document.querySelectorAll('.pdf-select');
        const deleteSelectedBtn = document.getElementById('deleteSelected');

        selectAll.addEventListener('change', function() {
            pdfCheckboxes.forEach(checkbox => checkbox.checked = this.checked);
            updateDeleteButton();
        });

        pdfCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateDeleteButton);
        });

        function updateDeleteButton() {
            const checkedBoxes = document.querySelectorAll('.pdf-select:checked');
            deleteSelectedBtn.disabled = checkedBoxes.length === 0;
        }

        // Upload form submission
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('{{ route('live-class-pdfs.upload') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    // Reload the page or update the table
                    location.reload();
                } else {
                    throw new Error(data.message);
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            });
        });

        // Delete single PDF
        document.querySelectorAll('.delete-pdf').forEach(button => {
            button.addEventListener('click', function() {
                const pdfId = this.dataset.id;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`{{ url('live-class-pdfs') }}/${pdfId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: data.message,
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                // Remove the row from the table
                                this.closest('tr').remove();
                            } else {
                                throw new Error(data.message);
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: error.message,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        });
                    }
                });
            });
        });

        // Delete multiple PDFs
        document.getElementById('deleteMultipleForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete them!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('{{ route('live-class-pdfs.deleteMultiple') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: data.message,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            // Reload the page or update the table
                            location.reload();
                        } else {
                            throw new Error(data.message);
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: error.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    });
                }
            });
        });
    });
</script>
@endpush