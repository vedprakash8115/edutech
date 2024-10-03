@extends('layout.app')
@section('content')

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
        @endforeach
        
        <!-- Example of a file (you can add these dynamically as well) -->
        <!-- <div class="file">
            <i class="file-icon fas fa-file-alt"></i>
            <span class="file-name">example.txt</span>
        </div> -->
    </div>
<script>

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
                    console.log(data);
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
                        subfolderContainer.innerHTML = '<p class="no-subfolders">No subfolders available.</p>';
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


@endsection
