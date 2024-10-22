<!-- Create Folder Modal -->
<div class="modal fade" id="createFolderModal" tabindex="-1" aria-labelledby="createFolderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form
                action="{{ isset($videoCourse) ? route('folders.create', $videoCourse->id) : route('folders.create', $folder->video_course_id) }}"
                method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createFolderModalLabel">Create New Folder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="parent_id"
                        value="{{ $currentRouteIsRootLevel ? null : ($folder->id ?? null) }}">
                    <div class="mb-3">
                        <label for="folderName" class="form-label">Folder Name</label>
                        <input type="text" class="form-control" id="folderName" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Folder</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upload PDF Modal -->
<div class="modal fade" id="uploadPdfModal" tabindex="-1" aria-labelledby="uploadPdfModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ isset($folder) ? route('folders.subfolder.upload', [$videoCourse ?? $videoCourse->id, $folder->id]) : route('folders.upload', $videoCourse->id) }}"
                method="POST" id="uploadPdfForm" enctype="multipart/form-data"> 
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadPdfModalLabel">Upload PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="pdfFile" class="form-label">Select PDF</label>
                        <input type="file" class="form-control" id="pdfFile" name="file" accept=".pdf" required>
                    </div>
                </div>
                <div id="uploadingMessage" style="display: none; text-align: center; color: blue; margin-top: 10px;">
                    Uploading, please wait...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload PDF</button>
                </div>


            </form>
        </div>
    </div>
</div>

<!-- Add Video Modal -->
<div class="modal fade" id="uploadVideoModal" tabindex="-1" aria-labelledby="uploadVideoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form
                action="{{ isset($folder) ? route('folders.subfolder.upload', [$videoCourse ?? $videoCourse->id, $folder->id]) : route('folders.upload', $videoCourse->id) }}"
                method="POST" enctype="multipart/form-data"> @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadVideoModalLabel">Upload Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="videoFile" class="form-label">Select Video</label>
                        <input type="file" class="form-control" id="videoFile" name="file" accept="video/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload Video</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- audio modal  -->
<div class="modal fade" id="uploadAudioModal" tabindex="-1" aria-labelledby="uploadAudioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form
                action="{{ isset($folder) ? route('folders.subfolder.upload', [$videoCourse ?? $videoCourse->id, $folder->id]) : route('folders.upload', $videoCourse->id) }}"
                method="POST" enctype="multipart/form-data"> @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadVideoModalLabel">Upload Audio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="videoFile" class="form-label">Select Audio</label>
                        <input type="file" class="form-control" id="videoFile" name="file" accept="video/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload Audio</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Image Modal -->
<div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form
                action="{{ isset($folder) ? route('folders.subfolder.upload', [$videoCourse ?? $videoCourse->id, $folder->id]) : route('folders.upload', $videoCourse->id) }}"
                method="POST" enctype="multipart/form-data">

                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadImageModalLabel">Upload Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="imageFile" class="form-label">Select Image</label>
                        <input type="file" class="form-control" id="imageFile" name="file" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- rename folder  -->
<div class="modal fade" id="renameFolderModal" tabindex="-1" aria-labelledby="renameFolderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="renameFolderForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="renameFolderModalLabel">Rename Folder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="folderName" class="form-label">Folder Name</label>
                        <input type="text" class="form-control" id="renameFolderName" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Rename Folder</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- delete modal  -->
<div class="modal fade" id="deleteFolderModal" tabindex="-1" aria-labelledby="deleteFolderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteFolderForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteFolderModalLabel">Delete Folder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this folder and all its contents?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete Folder</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- view pdf  -->
<!-- PDF Viewer Modal -->
<div class="modal fade" id="pdfViewerModal" tabindex="-1" aria-labelledby="pdfViewerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Adjust modal width -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfViewerModalLabel">PDF Viewer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 600px; overflow-y: auto;">
                <div id="pdfContainer"></div> <!-- Container for rendering multiple PDF pages -->
            </div>
        </div>
    </div>
</div>

<!-- Rename File Modal -->
<div class="modal fade" id="renameFileModal" tabindex="-1" aria-labelledby="renameFileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="renameFileForm" method="POST" action="/files/fileId/rename">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="renameFileModalLabel">Rename File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="renameFileName" class="form-label">File Name</label>
                        <input type="text" class="form-control" id="renameFileName" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Rename File</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete File Modal -->
<div class="modal fade" id="deleteFileModal" tabindex="-1" aria-labelledby="deleteFileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteFileForm" method="POST" action="/files/fileId/delete">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteFileModalLabel">Delete File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the file "<span id="fileToDeleteName"></span>"?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete File</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    // Get the Rename File Modal and its related elements
    var renameFileModal = document.getElementById('renameFileModal');
    var renameFileNameInput = document.getElementById('renameFileName');
    var renameFileForm = document.getElementById('renameFileForm');

    // Get the Delete File Modal and its related elements
    var deleteFileModal = document.getElementById('deleteFileModal');
    var fileToDeleteNameSpan = document.getElementById('fileToDeleteName');
    var deleteFileForm = document.getElementById('deleteFileForm');

    // When a Rename File button is clicked
    document.querySelectorAll('.rename-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            var fileId = button.getAttribute('data-file-id');
            var fileName = button.getAttribute('data-file-name');
    

            // Set the file name in the input field
            renameFileNameInput.value = fileName;

            // Set the form action dynamically with the correct file ID
            renameFileForm.setAttribute('action', '/files/' + fileId + '/rename');
        });
    });

    // When a Delete File button is clicked
    document.querySelectorAll('.delete-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            var fileId = button.getAttribute('data-file-id');
            var fileName = button.getAttribute('data-file-name');

            // Set the file name in the confirmation message
            fileToDeleteNameSpan.textContent = fileName;

            // Set the form action dynamically with the correct file ID
            deleteFileForm.setAttribute('action', '/files/' + fileId + '/delete');
        });
    });
});

</script>