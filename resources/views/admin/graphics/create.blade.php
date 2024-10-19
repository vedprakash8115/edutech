@extends('layout.app')

@section('title', 'Enhanced Admin Settings')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h3 mb-0 text-white" style="font-weight: 100;">ADD GRAPHICS</h1>
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{route('graphics.store')}}" method="POST" enctype="multipart/form-data" id="settingsForm">
                        @csrf
                        {{-- @method('PUT') --}}
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="logo" class="form-label fw-bold">Logo:</label>
                                    <input type="file" class="form-control" name="logo" id="logo" accept="image/*">
                                </div>
                                
                                <div class="mb-4">
                                    <label for="logo_width" class="form-label fw-bold">Logo Width:</label>
                                    <div class="d-flex align-items-center">
                                        <input type="range" class="form-range flex-grow-1 me-2" name="logo_width" id="logo_width" min="50" max="300" value="150">
                                        <span id="logo_width_value" class="badge bg-secondary">150px</span>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="logo_height" class="form-label fw-bold">Logo Height:</label>
                                    <div class="d-flex align-items-center">
                                        <input type="range" class="form-range flex-grow-1 me-2" name="logo_height" id="logo_height" min="50" max="300" value="150">
                                        <span id="logo_height_value" class="badge bg-secondary">150px</span>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Background Color:</label>
                                    <div class="mb-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="simple_color" name="bg_type" value="simple" checked>
                                            <label class="form-check-label" for="simple_color">Simple Color</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="gradient_color" name="bg_type" value="gradient">
                                            <label class="form-check-label" for="gradient_color">Gradient Color</label>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <input type="color" class="form-control form-control-color me-2" id="background_color" name="background_color" value="#ffffff">
                                        <input type="color" class="form-control form-control-color me-2" id="gradient_color_2" name="gradient_color_2" value="#ffffff" style="display:none;">
                                        <div class="gradient-preview" id="gradientPreview"></div>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="custom_text" class="form-label fw-bold">Custom Text:</label>
                                    <input type="text" class="form-control" name="custom_text" id="custom_text">
                                    <div class="d-flex justify-content-between mt-2">
                                        <small>Word count: <span id="word_count" class="badge bg-secondary">0</span></small>
                                        <div>
                                            <label for="text_size" class="form-label me-2">Text Size:</label>
                                            <select class="form-select form-select-sm d-inline-block w-auto" id="text_size" name="text_size">
                                                <option value="small">Small</option>
                                                <option value="medium" selected>Medium</option>
                                                <option value="large">Large</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="text_color" class="form-label fw-bold">Text Color:</label>
                                    <input type="color" class="form-control " id="text_color" name="text_color" value="#000000">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="preview-box mb-4 shadow-sm" id="preview_box">
                                    <img id="logo_preview" src="/api/placeholder/150/150" alt="Logo Preview" style="max-width: 100%; max-height: 100%;">
                                </div>
                                <div id="text_preview" class="p-3 border rounded mb-4"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="custom_url" class="form-label fw-bold">Custom URL:</label>
                            <input type="url" class="form-control" name="custom_url" id="custom_url">
                        </div>

                        <div class="mb-4">
                            <label for="condition" class="form-label fw-bold">Condition:</label>
                            <select class="form-select" name="condition" id="condition">
                                <option value="none">Select Condition</option>
                                <option value="date">From - To Date</option>
                                <option value="time">From - To Time</option>
                                <option value="interval">Interval</option>
                            </select>
                        </div>

                        <div id="date-fields" class="conditional-fields mb-4" style="display:none;">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="from_date" class="form-label fw-bold">From Date:</label>
                                    <input type="date" class="form-control" name="from_date" id="from_date">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="to_date" class="form-label fw-bold">To Date:</label>
                                    <input type="date" class="form-control" name="to_date" id="to_date">
                                </div>
                            </div>
                        </div>

                        <div id="time-fields" class="conditional-fields mb-4" style="display:none;">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="from_time" class="form-label fw-bold">From Time:</label>
                                    <input type="time" class="form-control" name="from_time" id="from_time">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="to_time" class="form-label fw-bold">To Time:</label>
                                    <input type="time" class="form-control" name="to_time" id="to_time">
                                </div>
                            </div>
                        </div>

                        <div id="interval-fields" class="conditional-fields mb-4" style="display:none;">
                            <label for="interval" class="form-label fw-bold">Interval:</label>
                            <select class="form-select" name="interval" id="interval">
                                <option value="morning">Morning</option>
                                <option value="afternoon">Afternoon</option>
                                <option value="evening">Evening</option>
                                <option value="night">Night</option>
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Save Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .preview-box {
        width: 100%;
        height: 200px;
        border: 1px solid #dee2e6;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
    }
    .color-preview {
        width: 30px;
        height: 30px;
        display: inline-block;
        margin-left: 10px;
        border: 1px solid #dee2e6;
    }
    .gradient-preview {
        width: 100px;
        height: 30px;
        display: inline-block;
        margin-left: 10px;
        border: 1px solid #dee2e6;
    }
    #text_preview {
        min-height: 100px;
        background-color: #f8f9fa;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const logoInput = document.getElementById('logo');
    const logoPreview = document.getElementById('logo_preview');
    const logoWidth = document.getElementById('logo_width');
    const logoHeight = document.getElementById('logo_height');
    const logoWidthValue = document.getElementById('logo_width_value');
    const logoHeightValue = document.getElementById('logo_height_value');
    const customText = document.getElementById('custom_text');
    const wordCount = document.getElementById('word_count');
    const textPreview = document.getElementById('text_preview');
    const textColor = document.getElementById('text_color');
    const textSize = document.getElementById('text_size');
    const backgroundColor = document.getElementById('background_color');
    const gradientColor2 = document.getElementById('gradient_color_2');
    const previewBox = document.getElementById('preview_box');
    const condition = document.getElementById('condition');
    const simpleColor = document.getElementById('simple_color');
    const gradientColor = document.getElementById('gradient_color');
    const gradientPreview = document.getElementById('gradientPreview');

    logoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                logoPreview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    logoWidth.addEventListener('input', function() {
        logoPreview.style.width = this.value + 'px';
        logoWidthValue.textContent = this.value + 'px';
    });

    logoHeight.addEventListener('input', function() {
        logoPreview.style.height = this.value + 'px';
        logoHeightValue.textContent = this.value + 'px';
    });

    customText.addEventListener('input', function() {
        const words = this.value.trim().split(/\s+/);
        wordCount.textContent = words.length;
        textPreview.textContent = this.value;
    });

    textColor.addEventListener('input', function() {
        textPreview.style.color = this.value;
    });

    textSize.addEventListener('change', function() {
        switch(this.value) {
            case 'small':
                textPreview.style.fontSize = '0.875rem';
                break;
            case 'medium':
                textPreview.style.fontSize = '1rem';
                break;
            case 'large':
                textPreview.style.fontSize = '1.25rem';
                break;
        }
    });

    function updateBackgroundColor() {
        if (simpleColor.checked) {
            previewBox.style.background = backgroundColor.value;
            gradientPreview.style.background = backgroundColor.value;
        } else {
            const gradient = `linear-gradient(to right, ${backgroundColor.value}, ${gradientColor2.value})`;
            previewBox.style.background = gradient;
            gradientPreview.style.background = gradient;
        }
    }

    backgroundColor.addEventListener('input', updateBackgroundColor);
    gradientColor2.addEventListener('input', updateBackgroundColor);

    simpleColor.addEventListener('change', function() {
        if (this.checked) {
            gradientColor2.style.display = 'none';
            updateBackgroundColor();
        }
    });

    gradientColor.addEventListener('change', function() {
        if (this.checked) {
            gradientColor2.style.display = 'inline-block';
            updateBackgroundColor();
        }
    });

    condition.addEventListener('change', function() {
        document.querySelectorAll('.conditional-fields').forEach(function(field) {
            field.style.display = 'none';
        });
        const selectedField = document.getElementById(this.value + '-fields');
        if (selectedField) {
            selectedField.style.display = 'block';
        }
    });

    // Initialize the form with default values
    logoWidth.value = 150;
    logoHeight.value = 150;
    logoWidthValue.textContent = '150px';
    logoHeightValue.textContent = '150px';
    updateBackgroundColor();
});
</script>

@endpush