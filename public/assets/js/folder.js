

document.addEventListener('click', function (e) {
    // Close all open menus when clicking outside
    if (!e.target.closest('.folder-item')) {
        document.querySelectorAll('.actions').forEach(actions => {
            actions.classList.remove('show');
        });
    }
});

document.querySelectorAll('.folder-item').forEach(folderItem => {
    const menu = folderItem.querySelector('.menu');
    const actions = folderItem.querySelector('.actions');
    const link = folderItem;

    // Toggle menu
    menu.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        actions.classList.toggle('show');
    });

    // Prevent link activation when clicking on actions
    actions.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
    });

    // Prevent link activation when clicking on action buttons
    actions.querySelectorAll('button').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            // Here you can add the specific action for each button
            // For example: if (this.classList.contains('rename-btn')) { ... }
        });
    });

    // Allow link activation only when clicking on the folder icon or name
    link.addEventListener('click', function (e) {
        if (e.target === this || e.target.closest('.folder-icon') || e.target.tagName === 'SPAN') {
            // This is a click on the folder itself, allow the default action
            return true;
        } else {
            // This is a click on a child element (menu or actions), prevent default
            e.preventDefault();
        }
    });
});
document.querySelectorAll('.file-item').forEach(folderItem => {
    const menu = folderItem.querySelector('.menu');
    const actions = folderItem.querySelector('.actions');
    const link = folderItem;

    // Toggle menu
    menu.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        actions.classList.toggle('show');
    });

    // Prevent link activation when clicking on actions
    actions.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
    });

    // Prevent link activation when clicking on action buttons
    actions.querySelectorAll('button').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            // Here you can add the specific action for each button
            // For example: if (this.classList.contains('rename-btn')) { ... }
        });
    });

    // Allow link activation only when clicking on the folder icon or name
    link.addEventListener('click', function (e) {
        if (e.target === this || e.target.closest('.file-icon') || e.target.tagName === 'SPAN') {
            // This is a click on the folder itself, allow the default action
            return true;
        } else {
            // This is a click on a child element (menu or actions), prevent default
            e.preventDefault();
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
    // Rename Folder Modal Population
    document.querySelectorAll('[data-bs-target="#renameFolderModal"]').forEach(button => {
        button.addEventListener('click', function () {
            const folderId = this.getAttribute('data-folder-id');
            const folderName = this.getAttribute('data-folder-name');
            document.getElementById('renameFolderForm').setAttribute('action', `/folders/${folderId}/rename`);
            document.getElementById('renameFolderName').value = folderName;
        });
    });

    // Delete Folder Modal Population
    document.querySelectorAll('[data-bs-target="#deleteFolderModal"]').forEach(button => {
        button.addEventListener('click', function () {
            const folderId = this.getAttribute('data-folder-id');
            document.getElementById('deleteFolderForm').setAttribute('action', `/folders/${folderId}/delete`);
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const fabMain = document.querySelector('.fab-main');
    const fabItems = document.querySelectorAll('.fab-item');

    fabMain.addEventListener('click', function () {
        fabItems.forEach((item, index) => {
            setTimeout(() => {
                item.style.transform = item.style.transform === 'scale(1)' ? 'scale(0)' : 'scale(1)';
                item.style.opacity = item.style.opacity === '1' ? '0' : '1';
            }, index * 100);
        });
    });
});
var pdfDoc = null; // To store the loaded PDF
var scale = 1.0; // Scale the PDF for appropriate size (can be adjusted)

// Function to render each page
function renderPage(pageNum, pdfDoc) {
    pdfDoc.getPage(pageNum).then(function (page) {
        var viewport = page.getViewport({ scale: scale });

        // Create a canvas element for the PDF page
        var canvas = document.createElement('canvas');
        var context = canvas.getContext('2d');

        // Set the canvas dimensions based on the viewport
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        // Adjust the canvas width to fit within the modal, and adjust the height proportionally
        canvas.style.width = '100%'; // Full width of modal
        canvas.style.height = 'auto'; // Maintain aspect ratio

        // Append the canvas to the pdfContainer div
        document.getElementById('pdfContainer').appendChild(canvas);

        // Render the PDF page into the canvas
        var renderContext = {
            canvasContext: context,
            viewport: viewport
        };
        page.render(renderContext);
    });
}

// Function to open the PDF and render all pages one by one
function openPDF(pdfUrl) {
    // Open the modal
    $('#pdfViewerModal').modal('show');

    // Clear the previous content of the pdfContainer
    document.getElementById('pdfContainer').innerHTML = '';

    // Load the PDF document
    var loadingTask = pdfjsLib.getDocument(pdfUrl);
    loadingTask.promise.then(function (pdf) {
        pdfDoc = pdf;

        // Render each page in sequence
        for (var pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
            renderPage(pageNum, pdfDoc);
        }
    }).catch(function (error) {
        console.error('Error loading PDF: ' + error);
    });
}
const resultsList = document.getElementById('resultsList');
    function clearResults() {
        resultsList.innerHTML = '';
        searchResults.style.display = 'none';
    }

    // Clear results when clicking outside
    document.addEventListener('click', function (event) {
        if (!event.target.closest('.search-bar-container')) {
            clearResults();
        }
    });

    // Clear results when search bar is empty
    folderSearch.addEventListener('blur', function () {
        if (this.value.trim() === '') {
            clearResults();
        }
});

// file remove and delete 

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

            // Update the form action to include the correct file ID
            var action = renameFileForm.getAttribute('action');
            renameFileForm.setAttribute('action', action.replace('fileId', fileId));
        });
    });

    // When a Delete File button is clicked
    document.querySelectorAll('.delete-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            var fileId = button.getAttribute('data-file-id');
            var fileName = button.getAttribute('data-file-name');

            // Set the file name in the confirmation message
            fileToDeleteNameSpan.textContent = fileName;

            // Update the form action to include the correct file ID
            var action = deleteFileForm.getAttribute('action');
            deleteFileForm.setAttribute('action', action.replace('fileId', fileId));
        });
    });
});

