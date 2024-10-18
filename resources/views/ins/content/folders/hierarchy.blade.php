@extends('layout.app')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="file-manager">
            <h3>Folder structure</h3>
            @foreach($rootFolders as $folder)
                <div class="folder" id="folder-{{ $folder->id }}">
                    <div class="folder-content">
                        <i class="folder-icon fas fa-folder"></i>
                        <span class="folder-name">{{ $folder->name }}</span>
                        <button class="expand-btn" data-folder-id="{{ $folder->id }}">
                            <i class="bi bi-plus-circle toggle"></i>
                        </button>
                    </div>
                    <div class="subfolder-container" id="subfolder-container-{{ $folder->id }}" style="display: none;">
                        <!-- Subfolders will be loaded here via AJAX -->
                    </div>
                </div>
                <!-- files -->
                <!-- <div class="file">
                        <i class="file-icon fas fa-file-alt"></i>
                        <span class="file-name">example.txt</span>
                    </div> -->
            @endforeach

        </div>
    </div>
    <div class="col-md-6">
        <div class="instruction-panel">
            <i class="instruction-icon bi bi-arrows-move"></i>
            <p class="instruction-text">Drag and drop to move folders/files</p>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>

<!-- <script>


    document.addEventListener('DOMContentLoaded', function () {
        // Function to attach event listeners and load subfolders dynamically
        function attachExpandListeners() {
            document.querySelectorAll('.expand-btn').forEach(function (button) {
                button.removeEventListener('click', expandFolder); // Remove previous listener to avoid duplicates
                button.addEventListener('click', expandFolder);    // Attach new event listener
            });
        }

        // Function to handle folder expansion
        function expandFolder() {
            let folderId = this.getAttribute('data-folder-id');
            let subfolderContainer = document.getElementById(`subfolder-container-${folderId}`);
            let toggleIcon = this.querySelector('.toggle');

            // Toggle icon
            toggleIcon.classList.toggle('bi-plus-circle');
            toggleIcon.classList.toggle('bi-dash-circle');

            // Check if subfolders are already loaded by using a data attribute
            if (!subfolderContainer.hasAttribute('data-loaded')) {
                // Make AJAX request to get subfolders
                fetch(`/folders/load-subfolders/${folderId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            // Loop through the received subfolders and append them to the container
                            data.forEach(subfolder => {
                                subfolderContainer.innerHTML += `
                                <div class="folder" id="folder-${subfolder.id}">
                                    <div class="folder-content">
                                        <i class="folder-icon fas fa-folder"></i>
                                        <span class="folder-name">${subfolder.name}</span>
                                        <button class="expand-btn" data-folder-id="${subfolder.id}">
                                            <i class="bi bi-plus-circle toggle"></i>
                                        </button>
                                    </div>
                                    <div class="subfolder-container" id="subfolder-container-${subfolder.id}" style="display: none;"></div>
                                </div>
                            `;
                            });

                            // Re-attach the expand event listeners to the newly added subfolders
                            attachExpandListeners();
                        } else {
                            subfolderContainer.innerHTML = '<h1 class="no-subfolders">No subfolders</h1>';
                        }

                        // Mark the container as loaded to avoid fetching again
                        subfolderContainer.setAttribute('data-loaded', 'true');

                        // Show the subfolder container
                        subfolderContainer.style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Error loading subfolders:', error);
                        // Revert icon if there's an error
                        toggleIcon.classList.toggle('bi-plus-circle');
                        toggleIcon.classList.toggle('bi-dash-circle');
                    });
            } else {
                // Toggle visibility of the subfolder container
                subfolderContainer.style.display = subfolderContainer.style.display === 'none' ? 'block' : 'none';
            }
        }

        // Initial call to attach listeners
        attachExpandListeners();
    });

</script>
<script>
    
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Sortable.js on the root container
        let containers = document.querySelectorAll('.subfolder-container');
        containers.forEach(function (container) {
            new Sortable(container, {
                group: 'nested', // Allow drag between containers
                animation: 150,
                fallbackOnBody: true,
                swapThreshold: 0.65,
                onEnd: function (/**Event*/evt) {
                    let draggedItemId = evt.item.getAttribute('id').split('-')[1]; // Extract folder ID from the dragged element
                    let targetFolderId = evt.to.getAttribute('id').split('-')[2]; // Extract target folder ID
                    // Make an AJAX request to update the folder hierarchy on the backend
                    fetch(`/folders/move-folder/${draggedItemId}/to/${targetFolderId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok ' + response.statusText);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Folder moved successfully:', data);
                        })
                        .catch(error => console.error('Error moving folder:', error));

                }
            });
        });
    });

</script> -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Sortable.js on all folder and file containers
        function initializeSortableOnContainers() {
            let containers = document.querySelectorAll('.subfolder-container, .files');
            containers.forEach(function (container) {
                new Sortable(container, {
                    group: 'nested', // Enable dragging between containers
                    animation: 150,
                    fallbackOnBody: true,
                    swapThreshold: 0.65,
                    onEnd: function (evt) {
                        // Extract dragged item type and ID
                        let draggedItemId = evt.item.getAttribute('id');
                        let draggedType = draggedItemId.split('-')[0]; // 'folder' or 'file'
                        let draggedId = draggedItemId.split('-')[1]; // Extract actual ID

                        // Determine target folder ID (or 'root' for top-level)
                        let targetFolderId = evt.to.closest('.folder') ? evt.to.closest('.folder').getAttribute('id').split('-')[1] : 'root';

                        // Remove "No subfolders" message if present in the target container
                        let noSubfoldersMessage = evt.to.querySelector('.no-subfolders');
                        if (noSubfoldersMessage) {
                            noSubfoldersMessage.remove();
                        }

                        // AJAX request to move folder or file
                        let url = '';
                        if (draggedType === 'folder') {
                            url = `/move-folder/${draggedId}/to/${targetFolderId}`;
                        } else if (draggedType === 'file') {
                            url = `/move-file/${draggedId}/to/${targetFolderId}`;
                        }

                        fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                            .then(response => {
                                if (!response.ok) throw new Error('Network response was not ok');
                                return response.json();
                            })
                            .then(data => {
                                // console.log(`${draggedType} moved successfully:`, data);
                            })
                            .catch(error => {
                                console.error(`Error moving ${draggedType}:`, error);
                                // alert(`An error occurred while moving the ${draggedType}. Please try again.`);
                            });
                    }
                });
            });
        }

        // Load subfolders via AJAX when the expand button is clicked
        function attachExpandListeners() {
            document.querySelectorAll('.expand-btn').forEach(function (button) {
                button.removeEventListener('click', expandFolder); // Remove previous listener to avoid duplicates
                button.addEventListener('click', expandFolder);    // Attach new event listener
            });
        }

        function expandFolder() {
            let folderId = this.getAttribute('data-folder-id');
            let subfolderContainer = document.getElementById(`subfolder-container-${folderId}`);
            let toggleIcon = this.querySelector('i');

            // Toggle icon between + and - when expanding/collapsing
            toggleIcon.classList.toggle('bi-plus-circle');
            toggleIcon.classList.toggle('bi-dash-circle');

            if (subfolderContainer.style.display === 'block') {
                subfolderContainer.style.display = 'none'; // Collapse the subfolder container
            } else {
                // If subfolders have not been loaded yet, load them via AJAX
                if (!subfolderContainer.hasAttribute('data-loaded')) {
                    fetch(`/folders/load-subfolders/${folderId}`)
                        .then(response => {
                            // Check if the response is valid JSON
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            const { subfolders, files } = data; // Destructure the response to get subfolders and files

                            // If there are files in the parent folder, append them first
                            if (files && files.length > 0 || subfolders && subfolders.length > 0) {
                                let parentFilesHTML = `<div class="files">`;
                                files.forEach(file => {
                                    parentFilesHTML += `
                    <div class="file" id="file-${file.id}">
                        <i class="file-icon fas fa-file-alt"></i>
                        <span class="file-name">${file.name}</span>
                    </div>
                `;
                                });
                                parentFilesHTML += `</div>`; // Close files div

                                // Append parent folder files before subfolders
                                subfolderContainer.innerHTML += parentFilesHTML;

                                // If there are subfolders, append them with their respective files
                                subfolders.forEach(subfolder => {
                                    // Subfolder HTML structure
                                    let subfolderHTML = `
                    <div class="folder" id="folder-${subfolder.id}">
                        <div class="folder-content">
                            <i class="folder-icon fas fa-folder"></i>
                            <span class="folder-name">${subfolder.name}</span>
                            <button class="expand-btn" data-folder-id="${subfolder.id}">
                                <i class="bi bi-plus-circle toggle"></i>
                            </button>
                        </div>
                        <div class="subfolder-container" id="subfolder-container-${subfolder.id}" style="display: none;"></div>
                    </div>
                `;

                                    // Append subfolder
                                    subfolderContainer.innerHTML += subfolderHTML;
                                });
                            } else {
                                subfolderContainer.innerHTML += `<div class="folder-content ms-4 no-subfolders">
                            <button class="expand-btn">
                                <i class="bi bi-circle-fill"></i>
                            </button>
                            <span class="folder-name">No subfolders</span>
                        </div>`
                            }

                            // Attach the expand button listeners to newly added subfolders
                            attachExpandListeners();

                            // Initialize sortable on new subfolders
                            initializeSortableOnContainers();

                            // Mark as loaded to avoid refetching
                            subfolderContainer.setAttribute('data-loaded', 'true');
                            subfolderContainer.style.display = 'block'; // Show the subfolder container
                        })
                        .catch(error => {
                            console.error('Error loading subfolders:', error);
                            toggleIcon.classList.toggle('bi-plus-circle');
                            toggleIcon.classList.toggle('bi-dash-circle');
                            alert('An error occurred while loading subfolders. Please try again.');
                        });

                } else {
                    subfolderContainer.style.display = subfolderContainer.style.display === 'none' ? 'block' : 'none';
                }

            }
        }

        // Initialize event listeners on page load
        attachExpandListeners();
        initializeSortableOnContainers();

    });


</script>

@endsection