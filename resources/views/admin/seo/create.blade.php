@extends('layout.app')

@section('content')
<div class="container-fluid mt-5">
    <h1 class="mb-4 text-primary" style="font-family:Georgia, 'Times New Roman', Times, serif">SEO SETTINGS</h1>
    <form action="{{ route('seo.store') }}" method="POST" id="seoForm">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card glassmorphism">
                    <h3 class="card-title mb-4" style="font-family: Georgia, 'Times New Roman', Times, serif; color:rgb(114, 114, 114)">Basic SEO Settings</h3>
                    <div class="card-body">
                    
                        <div class="mb-3 position-relative">
                            <label for="title" class="form-label">Meta Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="title">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea class="form-control" id="meta_description" name="meta_description" rows="3" required></textarea>
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="meta_description">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords">
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="meta_keywords">
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
                            <input type="text" class="form-control" id="og_title" name="og_title">
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="og_title">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    
                        <!-- OG Type -->
                        <div class="mb-3 position-relative">
                            <label for="og_type" class="form-label">OG Type</label>
                            <input type="text" class="form-control" id="og_type" name="og_type">
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="og_type">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    
                        <!-- OG URL -->
                        <div class="mb-3 position-relative">
                            <label for="og_url" class="form-label">OG URL</label>
                            <input type="url" class="form-control" id="og_url" name="og_url">
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="og_url">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    
                        <!-- OG Image URL -->
                        <div class="mb-3 position-relative">
                            <label for="og_image" class="form-label">OG Image URL</label>
                            <input type="url" class="form-control" id="og_image" name="og_image">
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="og_image">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    
                        <!-- OG Description -->
                        <div class="mb-3 position-relative">
                            <label for="og_description" class="form-label">OG Description</label>
                            <textarea class="form-control" id="og_description" name="og_description" rows="3"></textarea>
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="og_description">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    
                        <!-- OG Locale -->
                        <div class="mb-3 position-relative">
                            <label for="og_locale" class="form-label">OG Locale</label>
                            <select class="form-select" id="og_locale" name="og_locale">
                                <option value="en_US">English (United States)</option>
                                <option value="en_GB">English (United Kingdom)</option>
                                <option value="fr_FR">French (France)</option>
                                <option value="es_ES">Spanish (Spain)</option>
                            </select>
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="og_locale">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    
                        <!-- OG Video -->
                        <div class="mb-3 position-relative">
                            <label for="og_video" class="form-label">OG Video URL</label>
                            <input type="url" class="form-control" id="og_video" name="og_video">
                            <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="og_video">
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    
                        <!-- OG Audio -->
                        <div class="mb-3 position-relative">
                            <label for="og_audio" class="form-label">OG Audio URL</label>
                            <input type="url" class="form-control" id="og_audio" name="og_audio">
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
                                <div class="mb-3 position-relative">
                                    <label for="page_slug" class="form-label">Target Specific Page</label>
                                    <select class="form-select" id="page_slug" name="page_slug" required>
                                        <option value="" disabled selected>Select Target page</option>
                                        <option value="default">Default</option>
                                        <option value="home">Home Page</option>
                                        <option value="student_home">Student Home View</option>
                                    </select>
                                    <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="page_slug">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="author" class="form-label">Page Author</label>
                                    <input type="text" class="form-control" id="author" name="author">
                                    <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="author">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="copyright" class="form-label">Copyright</label>
                                    <input type="text" class="form-control" id="copyright" name="copyright">
                                    <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="copyright">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="canonical_url" class="form-label">Canonical URL</label>
                                    <input type="url" class="form-control" id="canonical_url" name="canonical_url">
                                    <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="canonical_url">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 position-relative">
                                    <label for="schema_markup" class="form-label">Schema Markup</label>
                                    <textarea class="form-control " id="schema_markup" name="schema_markup" rows="15" spellcheck="false">
                                        {
                                            "@context": "https://schema.org",
                                            "@type": "EducationalOrganization",
                                            "name": "Your Educational Website Name",
                                            "alternateName": "Your Brand Name",
                                            "url": "https://youreducationalwebsite.com",
                                            "logo": "https://youreducationalwebsite.com/logo.png",
                                            "description": "A detailed description of your educational organization",
                                            "foundingDate": "2000-01-01",
                                            "foundingLocation": {
                                              "@type": "Place",
                                              "address": {
                                                "@type": "PostalAddress",
                                                "streetAddress": "123 Main St",
                                                "addressLocality": "City",
                                                "addressRegion": "State",
                                                "postalCode": "12345",
                                                "addressCountry": "Country"
                                              }
                                            },
                                            "contactPoint": [
                                              {
                                                "@type": "ContactPoint",
                                                "telephone": "+1-800-555-5555",
                                                "contactType": "customer service",
                                                "email": "support@youreducationalwebsite.com",
                                                "availableLanguage": ["English", "Spanish"],
                                                "contactOption": "TollFree",
                                                "hoursAvailable": "Mo-Sa 09:00-18:00"
                                              },
                                              {
                                                "@type": "ContactPoint",
                                                "telephone": "+1-888-555-5555",
                                                "contactType": "sales",
                                                "email": "sales@youreducationalwebsite.com",
                                                "availableLanguage": "English",
                                                "contactOption": "TollFree",
                                                "hoursAvailable": "Mo-Fr 09:00-17:00"
                                              }
                                            ],
                                            "sameAs": [
                                              "https://www.facebook.com/youreducationalwebsite",
                                              "https://www.twitter.com/youreducationalwebsite",
                                              "https://www.linkedin.com/company/youreducationalwebsite",
                                              "https://www.instagram.com/youreducationalwebsite",
                                              "https://www.youtube.com/c/youreducationalwebsite"
                                            ],
                                            "numberOfEmployees": {
                                              "@type": "QuantitativeValue",
                                              "value": "100",
                                              "unitText": "employees"
                                            },
                                            "slogan": "Your Company Slogan",
                                            "knowsAbout": [
                                              "Online Courses",
                                              "Live Videos",
                                              "Live Classes",
                                              "E-books",
                                              "Books",
                                              "Teacher Chat"
                                            ],
                                            "hasOfferCatalog": {
                                              "@type": "OfferCatalog",
                                              "name": "Courses and Study Materials",
                                              "itemListElement": [
                                                {
                                                  "@type": "Offer",
                                                  "itemOffered": {
                                                    "@type": "Course",
                                                    "name": "Course 1",
                                                    "description": "Description of course 1"
                                                  }
                                                },
                                                {
                                                  "@type": "Offer",
                                                  "itemOffered": {
                                                    "@type": "Book",
                                                    "name": "Book 1",
                                                    "description": "Description of book 1"
                                                  }
                                                },
                                                {
                                                  "@type": "Offer",
                                                  "itemOffered": {
                                                    "@type": "E-book",
                                                    "name": "E-book 1",
                                                    "description": "Description of e-book 1"
                                                  }
                                                }
                                              ]
                                            },
                                            "areaServed": {
                                              "@type": "GeoCircle",
                                              "geoMidpoint": {
                                                "@type": "GeoCoordinates",
                                                "latitude": "40.7128",
                                                "longitude": "-74.0060"
                                              },
                                              "geoRadius": "50000"
                                            },
                                            "awards": [
                                              "Award 1",
                                              "Award 2"
                                            ]
                                          }
                                        </textarea>
                                    <button type="button" class="btn btn-info btn-sm info-btn" data-bs-toggle="modal" data-bs-target="#instructionsModal" data-field="schema_markup">
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
                <button type="submit" class="btn btn-primary btn-lg me-2">Save SEO Settings</button>
                <button type="reset" class="btn btn-secondary btn-lg">Reset Form</button>
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
    .glassmorphism {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 5px;
        /* border: 1px solid rgba(15, 33, 232, 0.801); */
        box-shadow: 0 1px 8px 2px #bbbcc4 ;
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
    h3
    {
        font-family: Georgia, 'Times New Roman', Times, serif;
        color:rgb(114, 114, 114) !important;
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
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('seoForm');
    const titleInput = document.getElementById('title');
    const metaDescriptionInput = document.getElementById('meta_description');
    const metaKeywordsInput = document.getElementById('meta_keywords');
    const schemaMarkupTextarea = document.getElementById('schema_markup');

    // Word counter for meta title and description
    function createWordCounter(inputElement, maxWords) {
        const counterSpan = document.createElement('span');
        counterSpan.className = 'word-count text-muted small ms-2';
        inputElement.parentNode.appendChild(counterSpan);

        function updateWordCount() {
            const wordCount = inputElement.value.trim().split(/\s+/).length;
            counterSpan.textContent = `${wordCount}/${maxWords} words`;
            counterSpan.classList.toggle('text-danger', wordCount > maxWords);
        }

        inputElement.addEventListener('input', updateWordCount);
        updateWordCount(); // Initial count
    }

    createWordCounter(titleInput, 10); // Most search engines display up to 50-60 characters
    createWordCounter(metaDescriptionInput, 30); // Most search engines display up to 150-160 characters

    // JSON validation for schema markup
    function validateSchemaMarkup() {
        try {
            JSON.parse(schemaMarkupTextarea.value);
            schemaMarkupTextarea.classList.remove('is-invalid');
            schemaMarkupTextarea.classList.add('is-valid');
        } catch (e) {
            schemaMarkupTextarea.classList.remove('is-valid');
            schemaMarkupTextarea.classList.add('is-invalid');
        }
    }

    schemaMarkupTextarea.addEventListener('input', validateSchemaMarkup);

    // Keyword suggestion feature
    function suggestKeywords() {
        const title = titleInput.value.toLowerCase();
        const description = metaDescriptionInput.value.toLowerCase();
        const words = (title + ' ' + description).split(/\s+/);
        const wordCounts = {};

        words.forEach(word => {
            if (word.length > 3) { // Ignore short words
                wordCounts[word] = (wordCounts[word] || 0) + 1;
            }
        });

        const sortedWords = Object.entries(wordCounts)
            .sort((a, b) => b[1] - a[1])
            .slice(0, 5)
            .map(entry => entry[0]);

        const suggestionDiv = document.createElement('div');
        suggestionDiv.className = 'mt-2';
        suggestionDiv.innerHTML = '<strong>Suggested keywords:</strong> ' + sortedWords.join(', ');

        const existingSuggestion = metaKeywordsInput.parentNode.querySelector('.keyword-suggestion');
        if (existingSuggestion) {
            existingSuggestion.remove();
        }

        suggestionDiv.classList.add('keyword-suggestion');
        metaKeywordsInput.parentNode.appendChild(suggestionDiv);
    }

    titleInput.addEventListener('input', suggestKeywords);
    metaDescriptionInput.addEventListener('input', suggestKeywords);

    // Character count for Open Graph fields
    function addCharCounter(inputElement, maxChars) {
        const counterSpan = document.createElement('span');
        counterSpan.className = 'char-count text-muted small ms-2';
        inputElement.parentNode.appendChild(counterSpan);

        function updateCharCount() {
            const charCount = inputElement.value.length;
            counterSpan.textContent = `${charCount}/${maxChars} characters`;
            counterSpan.classList.toggle('text-danger', charCount > maxChars);
        }

        inputElement.addEventListener('input', updateCharCount);
        updateCharCount(); // Initial count
    }

    addCharCounter(document.getElementById('og_title'), 60);
    addCharCounter(document.getElementById('og_description'), 200);

    // Preview function for Open Graph
    function updateOGPreview() {
        const previewDiv = document.getElementById('og-preview') || document.createElement('div');
        previewDiv.id = 'og-preview';
        previewDiv.className = 'card mt-3';
        previewDiv.innerHTML = `
            <div class="card-body">
                <h5 class="card-title">Open Graph Preview</h5>
                <div class="og-title">${document.getElementById('og_title').value}</div>
                <div class="og-description">${document.getElementById('og_description').value}</div>
                <div class="og-url">${document.getElementById('og_url').value}</div>
                <img src="${document.getElementById('og_image').value}" alt="OG Image" style="max-width: 100%; height: auto;">
            </div>
        `;
        document.getElementById('og_image').parentNode.appendChild(previewDiv);
    }

    ['og_title', 'og_description', 'og_url', 'og_image'].forEach(id => {
        document.getElementById(id).addEventListener('input', updateOGPreview);
    });

    // Form field completion progress bar
    const progressBar = document.createElement('div');
    progressBar.className = 'progress mt-3 mb-3';
    progressBar.innerHTML = '<div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>';
    form.prepend(progressBar);

    function updateProgress() {
        const fields = form.querySelectorAll('input[type="text"], input[type="url"], textarea, select');
        const totalFields = fields.length;
        let filledFields = 0;

        fields.forEach(field => {
            if (field.value.trim() !== '') filledFields++;
        });

        const progress = Math.round((filledFields / totalFields) * 100);
        const progressBarInner = progressBar.querySelector('.progress-bar');
        progressBarInner.style.width = `${progress}%`;
        progressBarInner.textContent = `${progress}%`;
        progressBarInner.setAttribute('aria-valuenow', progress);
    }

    form.addEventListener('input', updateProgress);

    // Save form data to localStorage
    function saveToLocalStorage() {
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());
        localStorage.setItem('seoFormData', JSON.stringify(data));
    }

    function loadFromLocalStorage() {
        const savedData = localStorage.getItem('seoFormData');
        if (savedData) {
            const data = JSON.parse(savedData);
            Object.keys(data).forEach(key => {
                const field = form.elements[key];
                if (field) field.value = data[key];
            });
            updateProgress();
            updateOGPreview();
        }
    }

    form.addEventListener('input', saveToLocalStorage);
    window.addEventListener('load', loadFromLocalStorage);

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Call initial functions
    validateSchemaMarkup();
    suggestKeywords();
    updateOGPreview();
    updateProgress();
});
</script>
<script>
// Wait for the DOM to be fully loaded before executing the script
document.addEventListener('DOMContentLoaded', function() {
    // Get the schema markup textarea element
    // const textarea = document.getElementById('schema_markup');
    // // Store the initial content of the textarea
    // let lastValidContent = textarea.value;
    
    // // Add an event listener for changes to the textarea
    // textarea.addEventListener('input', function(e) {
    //     // Split the textarea content into lines
    //     const lines = this.value.split('\n');
    //     let isValid = true;
        
    //     // Check each line of the textarea
    //     for (let i = 0; i < lines.length; i++) {
    //         const line = lines[i];
    //         // Check if the line is editable (contains the '/* EDITABLE */' comment)
    //         const isEditableLine = line.includes('/* EDITABLE */');
            
    //         if (!isEditableLine) {
    //             // If the line is not editable, compare it with the original content
    //             const originalLine = lastValidContent.split('\n')[i];
    //             if (line !== originalLine) {
    //                 // If the line has changed, mark the content as invalid
    //                 isValid = false;
    //                 break;
    //             }
    //         }
    //     }
        
    //     if (isValid) {
    //         // If the content is valid, update the lastValidContent
    //         lastValidContent = this.value;
    //     } else {
    //         // If the content is invalid, revert to the last valid content
    //         this.value = lastValidContent;
    //         // Restore the cursor position
    //         this.setSelectionRange(e.target.selectionStart - 1, e.target.selectionStart - 1);
    //     }
    // });

    // Add an event listener for the instructions modal
    $('#instructionsModal').on('show.bs.modal', function (event) {
        // Get the button that triggered the modal
        const button = $(event.relatedTarget);
        // Extract the field name from the button's data attribute
        const field = button.data('field');
        // Get the modal body element
        const modalBody = $(this).find('.modal-body');
        
        // Define instructions for each field
        const instructions = {
            title: "Enter the meta title of the page. This should be concise and descriptive.",
            meta_description: "Write a brief, compelling meta description of the page content. This appears in search engine results.",
            meta_keywords: "Enter relevant keywords separated by commas. These help search engines understand your page's content.",
            og_title: "Title for social media sharing. This may be different from your meta title.",
            og_type: "Type of content (e.g., article, website, product). This helps social media platforms display your content correctly.",
            og_url: "The canonical URL for your page. This should be the permanent URL you want associated with this content.",
            og_image: "URL of the image to display when shared on social media. Choose an image that represents your content well.",
            og_description: "A brief description for social media sharing. This may be different from your meta description.",
            page_slug: "Select the specific page you want to apply these SEO settings to.",
            author: "Specify the author of the page content. This can be an individual's name or an organization.",
            copyright: "Add copyright information for your content. This helps protect your intellectual property.",
            canonical_url: "Specify the preferred URL for this content. This helps prevent duplicate content issues.",
            schema_markup: "Enter structured data in JSON-LD format. This helps search engines understand your content better and can enhance your search results appearance."
        };
        
        // Set the instruction content in the modal body
        modalBody.text(instructions[field] || "No instructions available for this field.");
    });

    // Add form submission handler
    $('#seoForm').on('submit', function(e) {
        e.preventDefault();
        // Perform client-side validation
        var isValid = true;
        $('input[required], textarea[required], select[required]').each(function() {
            if ($(this).val().trim() === '') {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (isValid) {
            // If the form is valid, submit it
            this.submit();
        } else {
            // If the form is invalid, show an alert
            alert('Please fill in all required fields.');
        }
    });
});
</script>
@endpush