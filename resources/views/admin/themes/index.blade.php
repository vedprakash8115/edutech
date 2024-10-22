@extends('layout.app')

@section('title', 'Select Theme')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <h1 class="h3 mb-0 text-white text-center" style="font-weight: 300;">Select Your Theme</h1>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="theme-selector mb-4">
                                <h4 class="mb-3">Available Themes</h4>
                                <div class="list-group" id="themeList">
                                    <!-- Themes will be dynamically populated here -->
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <!-- Hidden form for applying the theme -->
                                <form id="applyThemeForm" method="POST" action="{{ route('apply.theme') }}">
                                    @csrf
                                    <input type="hidden" name="theme_id" id="selectedThemeId">
                                    <button type="button" id="applyTheme" class="btn btn-primary btn-lg px-5">Apply Theme</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h4 class="mb-3">Theme Preview</h4>
                            <div class="iframe-container" style="height: 600px; border: 1px solid #dee2e6; border-radius: 0.25rem; overflow: hidden;">
                                <iframe id="themePreview" src="" style="width: 100%; height: 100%; border: none;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Same styles as before */
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const themeList = document.getElementById('themeList');
        const themePreview = document.getElementById('themePreview');
        const applyThemeButton = document.getElementById('applyTheme');
        const selectedThemeInput = document.getElementById('selectedThemeId');
        let selectedTheme = null;

        // Fetch available themes
        fetch('/api/themes')
            .then(response => response.json())
            .then(themes => {
                themes.forEach(theme => {
                    const themeItem = document.createElement('a');
                    themeItem.classList.add('list-group-item', 'list-group-item-action');
                    themeItem.textContent = theme.name;
                    themeItem.dataset.themeId = theme.id;
                    themeList.appendChild(themeItem);

                    themeItem.addEventListener('click', function() {
                        // Remove active class from all items
                        themeList.querySelectorAll('.list-group-item').forEach(item => {
                            item.classList.remove('active');
                        });

                        // Add active class to clicked item
                        this.classList.add('active');

                        // Update selected theme
                        selectedTheme = theme.id;
                        selectedThemeInput.value = theme.id; // Set hidden input value

                        // Load theme preview
                        themePreview.src = `/api/theme-preview/${theme.id}`;
                    });
                });
            });

        // Apply theme button click handler
        applyThemeButton.addEventListener('click', function() {
            if (selectedTheme) {
                // Submit the form
                document.getElementById('applyThemeForm').submit();
            } else {
                alert('Please select a theme first.');
            }
        });
    });
</script>
@endpush
