@extends('layout.app')

@section('title', 'Edit Graphics')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h1 class="h3 mb-0 text-white text-center" style="font-weight: 300;">Edit Your Graphics</h1>
                </div>
                <div class="card-body p-4">
                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('graphics.update', $graphic->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h4 class="mb-4 text-center">Ad Header Customization</h4>
                                
                                <div class="mb-4">
                                    <label for="logo" class="form-label">Logo:</label>
                                    <input type="file" class="form-control" name="logo" id="logo" accept="image/*">
                                    @if($graphic->logo)
                                        <img src="{{ asset($graphic->logo) }}" alt="Current Logo" class="mt-2" style="max-width: 100px;">
                                    @endif
                                </div>
                                
                                <div class="mb-4">
                                    <label for="logo_width" class="form-label">Logo Width:</label>
                                    <div class="d-flex align-items-center">
                                        <input type="range" class="form-range flex-grow-1 me-2" name="logo_width" id="logo_width" min="50" max="300" value="{{ $graphic->logo_width }}">
                                        <span id="logo_width_value" class="badge bg-secondary">{{ $graphic->logo_width }}px</span>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="logo_height" class="form-label">Logo Height:</label>
                                    <div class="d-flex align-items-center">
                                        <input type="range" class="form-range flex-grow-1 me-2" name="logo_height" id="logo_height" min="50" max="300" value="{{ $graphic->logo_height }}">
                                        <span id="logo_height_value" class="badge bg-secondary">{{ $graphic->logo_height }}px</span>
                                    </div>
                                </div>
                                
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="logo_horizontal_position" class="form-label">Logo Horizontal Position:</label>
                                        <select class="form-select" name="logo_horizontal_position" id="logo_horizontal_position">
                                            <option value="left" {{ $graphic->logo_horizontal_position == 'left' ? 'selected' : '' }}>Left</option>
                                            <option value="center" {{ $graphic->logo_horizontal_position == 'center' ? 'selected' : '' }}>Center</option>
                                            <option value="right" {{ $graphic->logo_horizontal_position == 'right' ? 'selected' : '' }}>Right</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="logo_vertical_position" class="form-label">Logo Vertical Position:</label>
                                        <select class="form-select" name="logo_vertical_position" id="logo_vertical_position">
                                            <option value="top" {{ $graphic->logo_vertical_position == 'top' ? 'selected' : '' }}>Top</option>
                                            <option value="middle" {{ $graphic->logo_vertical_position == 'middle' ? 'selected' : '' }}>Middle</option>
                                            <option value="bottom" {{ $graphic->logo_vertical_position == 'bottom' ? 'selected' : '' }}>Bottom</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="header_background_color" class="form-label">Header Background Color:</label>
                                        <input type="color" class="form-control form-control-color w-100" id="header_background_color" name="header_background_color" value="{{ $graphic->header_background_color }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="header_border_color" class="form-label">Header Border Color:</label>
                                        <input type="color" class="form-control form-control-color w-100" id="header_border_color" name="header_border_color" value="{{ $graphic->header_border_color }}">
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="header_text" class="form-label">Header Text:</label>
                                    <input type="text" class="form-control" name="header_text" id="header_text" value="{{ $graphic->header_text }}">
                                </div>
                                
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="header_text_color" class="form-label">Header Text Color:</label>
                                        <input type="color" class="form-control form-control-color w-100" id="header_text_color" name="header_text_color" value="{{ $graphic->header_text_color }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="header_font" class="form-label">Header Font:</label>
                                        <select class="form-select" name="header_font" id="header_font">
                                            <option value="Arial, sans-serif" {{ $graphic->header_font == 'Arial, sans-serif' ? 'selected' : '' }}>Arial</option>
                                            <option value="Helvetica, sans-serif" {{ $graphic->header_font == 'Helvetica, sans-serif' ? 'selected' : '' }}>Helvetica</option>
                                            <option value="Times New Roman, serif" {{ $graphic->header_font == 'Times New Roman, serif' ? 'selected' : '' }}>Times New Roman</option>
                                            <option value="Georgia, serif" {{ $graphic->header_font == 'Georgia, serif' ? 'selected' : '' }}>Georgia</option>
                                            <option value="Courier New, monospace" {{ $graphic->header_font == 'Courier New, monospace' ? 'selected' : '' }}>Courier New</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="header_text_horizontal_position" class="form-label">Text Horizontal Position:</label>
                                        <select class="form-select" name="header_text_horizontal_position" id="header_text_horizontal_position">
                                            <option value="left" {{ $graphic->header_text_horizontal_position == 'left' ? 'selected' : '' }}>Left</option>
                                            <option value="center" {{ $graphic->header_text_horizontal_position == 'center' ? 'selected' : '' }}>Center</option>
                                            <option value="right" {{ $graphic->header_text_horizontal_position == 'right' ? 'selected' : '' }}>Right</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="header_text_vertical_position" class="form-label">Text Vertical Position:</label>
                                        <select class="form-select" name="header_text_vertical_position" id="header_text_vertical_position">
                                            <option value="top" {{ $graphic->header_text_vertical_position == 'top' ? 'selected' : '' }}>Top</option>
                                            <option value="middle" {{ $graphic->header_text_vertical_position == 'middle' ? 'selected' : '' }}>Middle</option>
                                            <option value="bottom" {{ $graphic->header_text_vertical_position == 'bottom' ? 'selected' : '' }}>Bottom</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="header_font_size" class="form-label">Header Font Size:</label>
                                    <input type="number" class="form-control" name="header_font_size" id="header_font_size" value="{{ $graphic->header_font_size }}" min="8" max="72">
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <h4 class="mb-4 text-center">Top Bar Preview</h4>
                                <div class="preview-box mb-4 shadow-sm" id="top_bar_preview" style="position: relative; width: 100%; height: 200px; border: 1px solid #ccc; overflow: hidden;">
                                    <div id="preview_logo_container" style="position: absolute;">
                                        <img id="preview_logo" src="{{ asset($graphic->logo) }}" alt="Logo Preview" style="max-width: 150px; max-height: 150px;">
                                    </div>
                                    <div id="preview_text" style="position: absolute;"></div>
                                </div>

                                <div class="mb-4">
                                    <label for="custom_url" class="form-label">Custom URL:</label>
                                    <input type="url" class="form-control" name="custom_url" id="custom_url" value="{{ $graphic->custom_url }}" placeholder="https://example.com">
                                </div>

                                <div class="mb-4">
                                    <label for="condition" class="form-label">Condition:</label>
                                    <select class="form-select" name="condition" id="condition">
                                        <option value="none" {{ $graphic->condition == 'none' ? 'selected' : '' }}>Select Condition</option>
                                        <option value="date" {{ $graphic->condition == 'date' ? 'selected' : '' }}>From - To Date</option>
                                        <option value="time" {{ $graphic->condition == 'time' ? 'selected' : '' }}>From - To Time</option>
                                        <option value="interval" {{ $graphic->condition == 'interval' ? 'selected' : '' }}>Interval</option>
                                    </select>
                                </div>

                                <div id="date-fields" class="conditional-fields mb-4" style="display:none;">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="from_date" class="form-label">From Date:</label>
                                            <input type="date" class="form-control" name="from_date" id="from_date" value="{{ $graphic->from_date }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="to_date" class="form-label">To Date:</label>
                                            <input type="date" class="form-control" name="to_date" id="to_date" value="{{ $graphic->to_date }}">
                                        </div>
                                    </div>
                                </div>

                                <div id="time-fields" class="conditional-fields mb-4" style="display:none;">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="from_time" class="form-label">From Time:</label>
                                            <input type="time" class="form-control" name="from_time" id="from_time" value="{{ $graphic->from_time }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="to_time" class="form-label">To Time:</label>
                                            <input type="time" class="form-control" name="to_time" id="to_time" value="{{ $graphic->to_time }}">
                                        </div>
                                    </div>
                                </div>

                                <div id="interval-fields" class="conditional-fields mb-4" style="display:none;">
                                    <label for="interval" class="form-label">Interval:</label>
                                    <select class="form-select" name="interval" id="interval">
                                        <option value="morning" {{ $graphic->interval == 'morning' ? 'selected' : '' }}>Morning</option>
                                        <option value="afternoon" {{ $graphic->interval == 'afternoon' ? 'selected' : '' }}>Afternoon</option>
                                        <option value="evening" {{ $graphic->interval == 'evening' ? 'selected' : '' }}>Evening</option>
                                        <option value="night" {{ $graphic->interval == 'night' ? 'selected' : '' }}>Night</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">Update Graphics</button>
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
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .card-header {
        border-radius: 15px 15px 0 0;
    }
    .form-label {
        font-weight: 600;
        color: #4a4a4a;
    }
    .preview-box {
        background-color: #fff;
        border-radius: 10px;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
    .preview-box {
        width: 100%;
        height: 200px;
        border: 1px solid #dee2e6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        background-color: #f8f9fa;
        position: relative;
    }
    #preview_logo_container, #preview_text, #preview_button {
        position: absolute;
    }
    .form-range::-webkit-slider-thumb {
        background: #007bff;
    }
    .form-range::-moz-range-thumb {
        background: #007bff;
    }
    .form-range::-ms-thumb {
        background: #007bff;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get references to all input elements
    const logoInput = document.getElementById('logo');
    const logoWidthInput = document.getElementById('logo_width');
    const logoHeightInput = document.getElementById('logo_height');
    const logoHorizontalPosition = document.getElementById('logo_horizontal_position');
    const logoVerticalPosition = document.getElementById('logo_vertical_position');
    const headerBackgroundColor = document.getElementById('header_background_color');
    const headerBorderColor = document.getElementById('header_border_color');
    const headerText = document.getElementById('header_text');
    const headerTextColor = document.getElementById('header_text_color');
    const headerTextHorizontalPosition = document.getElementById('header_text_horizontal_position');
    const headerTextVerticalPosition = document.getElementById('header_text_vertical_position');
    const headerFont = document.getElementById('header_font');
    const headerFontSize = document.getElementById('header_font_size');

    // Get references to preview elements
    const previewBox = document.getElementById('top_bar_preview');
    const previewLogoContainer = document.getElementById('preview_logo_container');
    const previewLogo = document.getElementById('preview_logo');
    const previewText = document.getElementById('preview_text');

    // Function to update the preview
    function updatePreview() {
        // Update logo
        if (logoInput.files && logoInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewLogo.src = e.target.result;
            }
            reader.readAsDataURL(logoInput.files[0]);
        }

        // Update logo size
        previewLogo.style.width = `${logoWidthInput.value}px`;
        previewLogo.style.height = `${logoHeightInput.value}px`;

        // Update logo position
        previewLogoContainer.style.left = logoHorizontalPosition.value === 'left' ? '10px' : 
                                          logoHorizontalPosition.value === 'right' ? 'auto' : '50%';
        previewLogoContainer.style.right = logoHorizontalPosition.value === 'right' ? '10px' : 'auto';
        previewLogoContainer.style.transform = logoHorizontalPosition.value === 'center' ? 'translateX(-50%)' : 'none';
        
        previewLogoContainer.style.top = logoVerticalPosition.value === 'top' ? '10px' : 
                                         logoVerticalPosition.value === 'bottom' ? 'auto' : '50%';
        previewLogoContainer.style.bottom = logoVerticalPosition.value === 'bottom' ? '10px' : 'auto';
        previewLogoContainer.style.transform += logoVerticalPosition.value === 'middle' ? ' translateY(-50%)' : '';

        // Update header background and border
        previewBox.style.backgroundColor = headerBackgroundColor.value;
        previewBox.style.borderColor = headerBorderColor.value;

        // Update header text
        previewText.textContent = headerText.value;
        previewText.style.color = headerTextColor.value;
        previewText.style.fontFamily = headerFont.value;
        previewText.style.fontSize = `${headerFontSize.value}px`;

        // Update text position
        previewText.style.left = headerTextHorizontalPosition.value === 'left' ? '10px' : 
                                 headerTextHorizontalPosition.value === 'right' ? 'auto' : '50%';
        previewText.style.right = headerTextHorizontalPosition.value === 'right' ? '10px' : 'auto';
        previewText.style.transform = headerTextHorizontalPosition.value === 'center' ? 'translateX(-50%)' : 'none';
        
        previewText.style.top = headerTextVerticalPosition.value === 'top' ? '10px' : 
                                headerTextVerticalPosition.value === 'bottom' ? 'auto' : '50%';
        previewText.style.bottom = headerTextVerticalPosition.value === 'bottom' ? '10px' : 'auto';
        previewText.style.transform += headerTextVerticalPosition.value === 'middle' ? ' translateY(-50%)' : '';
    }

    // Add event listeners to all input elements
    logoInput.addEventListener('change', updatePreview);
    logoWidthInput.addEventListener('input', updatePreview);
    logoHeightInput.addEventListener('input', updatePreview);
    logoHorizontalPosition.addEventListener('change', updatePreview);
    logoVerticalPosition.addEventListener('change', updatePreview);
    headerBackgroundColor.addEventListener('input', updatePreview);
    headerBorderColor.addEventListener('input', updatePreview);
    headerText.addEventListener('input', updatePreview);
    headerTextColor.addEventListener('input', updatePreview);
    headerTextHorizontalPosition.addEventListener('change', updatePreview);
    headerTextVerticalPosition.addEventListener('change', updatePreview);
    headerFont.addEventListener('change', updatePreview);
    headerFontSize.addEventListener('input', updatePreview);

    // Update width and height value displays
    logoWidthInput.addEventListener('input', function() {
        document.getElementById('logo_width_value').textContent = `${this.value}px`;
    });
    logoHeightInput.addEventListener('input', function() {
        document.getElementById('logo_height_value').textContent = `${this.value}px`;
    });

    // Initial preview update
    updatePreview();

    // Condition fields toggle
    const conditionSelect = document.getElementById('condition');
    const dateFields = document.getElementById('date-fields');
    const timeFields = document.getElementById('time-fields');
    const intervalFields = document.getElementById('interval-fields');

    function toggleFields() {
        const selectedCondition = conditionSelect.value;
        
        dateFields.style.display = 'none';
        timeFields.style.display = 'none';
        intervalFields.style.display = 'none';

        if (selectedCondition === 'date') {
            dateFields.style.display = 'block';
        } else if (selectedCondition === 'time') {
            timeFields.style.display = 'block';
        } else if (selectedCondition === 'interval') {
            intervalFields.style.display = 'block';
        }
    }

    conditionSelect.addEventListener('change', toggleFields);
    toggleFields();
});
</script>
@endpush