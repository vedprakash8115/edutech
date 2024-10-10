@extends('layout.app')

@section('content')
<div class="container-fluid mt-5">
    <h1 class="mb-4 text-primary">Edit SEO Data</h1>
    <form action="{{ route('seo.update', $seo->id) }}" method="POST" id="seoForm">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card glassmorphism">
                    <h3 class="card-title mb-4">Basic SEO Settings</h3>
                    <div class="card-body">
                       
                        <div class="mb-3 position-relative">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $seo->meta_title }}" required>
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="meta_title">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea class="form-control" id="meta_description" name="meta_description" rows="3" required>{{ $seo->meta_description }}</textarea>
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="meta_description">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="keywords" class="form-label">Meta Keywords</label>
                            <input type="text" class="form-control" id="keywords" name="keywords" value="{{ $seo->keywords }}">
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="keywords">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card glassmorphism">
                    <h3 class="card-title mb-4">Open Graph Tags</h3>
                        
                    <div class="card-body">
                  
                        <!-- OG Title -->
                        <div class="mb-3 position-relative">
                            <label for="og_title" class="form-label">OG Title</label>
                            <input type="text" class="form-control" id="og_title" name="og_title" value="{{ $seo->og_title }}">
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="og_title">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    
                        <!-- OG Description -->
                        <div class="mb-3 position-relative">
                            <label for="og_description" class="form-label">OG Description</label>
                            <textarea class="form-control" id="og_description" name="og_description" rows="3">{{ $seo->og_description }}</textarea>
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="og_description">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    
                        <!-- OG Type -->
                        <div class="mb-3 position-relative">
                            <label for="og_type" class="form-label">OG Type</label>
                            <input type="text" class="form-control" id="og_type" name="og_type" value="{{ $seo->og_type }}">
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="og_type">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    
                        <!-- OG URL -->
                        <div class="mb-3 position-relative">
                            <label for="og_url" class="form-label">OG URL</label>
                            <input type="url" class="form-control" id="og_url" name="og_url" value="{{ $seo->og_url }}">
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="og_url">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    
                        <!-- OG Image -->
                        <div class="mb-3 position-relative">
                            <label for="og_image" class="form-label">OG Image</label>
                            <input type="url" class="form-control" id="og_image" name="og_image" value="{{ $seo->og_image }}">
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="og_image">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    
                        <!-- OG Locale (Dropdown) -->
                        <div class="mb-3 position-relative">
                            <label for="og_locale" class="form-label">OG Locale</label>
                            <select class="form-control" id="og_locale" name="og_locale">
                                <option value="en_US" {{ $seo->og_locale == 'en_US' ? 'selected' : '' }}>English (US)</option>
                                <option value="en_GB" {{ $seo->og_locale == 'en_GB' ? 'selected' : '' }}>English (UK)</option>
                                <option value="fr_FR" {{ $seo->og_locale == 'fr_FR' ? 'selected' : '' }}>French (France)</option>
                                <option value="es_ES" {{ $seo->og_locale == 'es_ES' ? 'selected' : '' }}>Spanish (Spain)</option>
                                <option value="de_DE" {{ $seo->og_locale == 'de_DE' ? 'selected' : '' }}>German (Germany)</option>
                                <!-- Add more options as needed -->
                            </select>
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="og_locale">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    
                        <!-- OG Video -->
                        <div class="mb-3 position-relative">
                            <label for="og_video" class="form-label">OG Video</label>
                            <input type="url" class="form-control" id="og_video" name="og_video" value="{{ $seo->og_video }}">
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="og_video">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    
                        <!-- OG Audio -->
                        <div class="mb-3 position-relative">
                            <label for="og_audio" class="form-label">OG Audio</label>
                            <input type="url" class="form-control" id="og_audio" name="og_audio" value="{{ $seo->og_audio }}">
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="og_audio">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card glassmorphism">
                    <h3 class="card-title mb-4">Advanced SEO Settings</h3>
                    <div class="card-body">
                    
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Page Slug -->
                                <div class="mb-3 position-relative">
                                    <label for="page_slug" class="form-label">Target Page</label>
                                    <input type="text" class="form-control" id="page_slug" name="page_slug" value="{{ $seo->page_slug }}" readonly>
                                    <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="page_slug">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </div>
                                
                                <!-- Canonical URL -->
                                <div class="mb-3 position-relative">
                                    <label for="canonical_url" class="form-label">Canonical URL</label>
                                    <input type="url" class="form-control" id="canonical_url" name="canonical_url" value="{{ $seo->canonical_url }}">
                                    <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="canonical_url">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </div>
                    
                                <!-- Page Author -->
                                <div class="mb-3 position-relative">
                                    <label for="page_author" class="form-label">Page Author</label>
                                    <input type="text" class="form-control" id="page_author" name="page_author" value="{{ $seo->author }}">
                                    <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="page_author">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </div>
                            </div>
                    
                            <div class="col-md-6">
                                <!-- Schema Markup -->
                                <div class="mb-3 position-relative">
                                    <label for="schema_markup" class="form-label">Schema Markup</label>
                                    <textarea class="form-control" id="schema_markup" name="schema_markup" rows="10">{{ $seo->schema_markup }}</textarea>
                                    <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="schema_markup">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </div>
                    
                                <!-- Copyright -->
                                <div class="mb-3 position-relative">
                                    <label for="copyright" class="form-label">Copyright</label>
                                    <input type="text" class="form-control" id="copyright" name="copyright" value="{{ $seo->copyright }}">
                                    <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="copyright">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-lg me-2">Update SEO Settings</button>
                <a href="{{ route('seo.index') }}" class="btn btn-secondary btn-lg">Cancel</a>
            </div>
        </div>
    </form>
</div>

<!-- Instructions Modal -->
<div class="modal fade" id="instructionsModal" tabindex="-1" aria-labelledby="instructionsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content glassmorphism">
            <div class="modal-header">
                <h5 class="modal-title" id="instructionsModalLabel">Field Instructions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="instructionsContent">
                <!-- Instructions content will be dynamically inserted here -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>

    body {
        background: whitesmoke !important;
        background-color: whitesmoke !important;
        color: #000b3f;
        font-family: 'Arial', sans-serif;
        min-height: 100vh;
    }
    .card-title
    {
        padding: 15px 0px 10px 0px  ;
        background: #bbbcc453;
        color: rgba(149, 149, 149, 0.9);
        display: flex;
        text-align: center;
        justify-content: center;
        align-content: center;
        /* border-bottom: 1px solid black; */
        box-shadow: 0px 2px 2px rgba(22, 21, 21, 0.485);
        overflow: hidden;
    }
    .glassmorphism {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 5px;
        /* border: 1px solid rgba(15, 33, 232, 0.801); */
        box-shadow: 0 1px 8px 2px #bbbcc4 ;
    }
    .form-label {
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .fas
    {
        color: #000b3f !important;
        font-size: 16px;
    }
    .info-btn {
        position: absolute;
        right: 10px;
        top: 32px;
        padding: 0.25rem 0.5rem;
        background-color: rgba(255, 255, 255, 0.2);
        border: none;
        color: #ffffff;
    }
    .info-btn:hover {
        background-color: rgba(255, 255, 255, 0.3);
    }
    .btn-primary {
        background-color: #4e54c8;
        border-color: #4e54c8;
    }
    .btn-primary:hover {
        background-color: #3f45b0;
        border-color: #3f45b0;
    }
    h1, h3 {
        font-weight: 300;
        letter-spacing: 1px;
    }
    .form-control, .form-select {
        background-color: rgba(255, 255, 255, 0.1);
        /* /* border: none; */
        border-radius: 0%;
        border-bottom: 1px solid rgb(19, 1, 63);
        box-shadow: none;
       
        color: #030000;
    }
    .form-control:focus, .form-select:focus {
        background-color: rgba(255, 255, 255, 0.2);
        border-color: rgb(15, 0, 79);
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
        color: #000000;
    }
    .form-control::placeholder, .form-select::placeholder {
        color: rgba(0, 0, 0, 0.7);
    }
    .modal-content.glassmorphism {
        background: rgba(255, 255, 255, 0.2);
    }

</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#instructionsModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const field = button.data('field');
        const modalBody = $(this).find('.modal-body');
        
        const instructions = {
            meta_title: "Enter the meta title of the page. This should be concise and descriptive (max 60 characters).",
            meta_description: "Write a brief, compelling meta description of the page content. This appears in search engine results (max 160 characters).",
            keywords: "Enter relevant keywords separated by commas. These help search engines understand your page's content.",
            og_title: "Title for social media sharing. This may be different from your meta title.",
            og_description: "A brief description for social media sharing. This may be different from your meta description.",
            page_slug: "The target page for these SEO settings. This field is read-only.",
            canonical_url: "Specify the preferred URL for this content. This helps prevent duplicate content issues.",
            schema_markup: "Enter structured data in JSON-LD format. This helps search engines understand your content better and can enhance your search results appearance."
        };
        
        modalBody.text(instructions[field] || "No instructions available for this field.");
    });

    $('#seoForm').on('submit', function(e) {
        e.preventDefault();
        var isValid = true;
        $('input[required], textarea[required]').each(function() {
            if ($(this).val().trim() === '') {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (isValid) {
            this.submit();
        } else {
            alert('Please fill in all required fields.');
        }
    });
});
</script>
@endpush