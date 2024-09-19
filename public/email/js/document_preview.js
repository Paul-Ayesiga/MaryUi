document.addEventListener('DOMContentLoaded', function () {
    const documentInput = document.getElementById('documents');
    const previewContainer = document.getElementById('document-previews');
    const clearButton = document.getElementById('clear-button'); // Assuming a clear button with this ID

    // Array to store selected files
    let selectedFiles = [];

    documentInput.addEventListener('change', function (event) {
        previewContainer.innerHTML = ''; // Clear existing previews
        selectedFiles = Array.from(event.target.files); // Update selected files

        // Generate previews for each selected file
        selectedFiles.forEach(file => {
            const fileReader = new FileReader();
            const fileType = file.type.split('/')[1]; // Get file extension
            const fileTypeGroup = file.type.split('/')[0]; // Get file type group (e.g., 'image', 'application')

            fileReader.onload = function (event) {
                // Create file preview element
                const previewItem = document.createElement('div');
                previewItem.className = 'document-preview';

                let previewContent;

                // Create preview based on file type
                if (fileTypeGroup === 'image') {
                    // Display image preview
                    previewContent = document.createElement('img');
                    previewContent.src = event.target.result;
                    previewContent.className = 'file-preview-image';
                } else {
                    // Display icon
                    previewContent = document.createElement('img');
                    previewContent.src = getFileIcon(fileType);
                    previewContent.className = 'file-icon';
                }

                // Create file name with a removal button
                const fileName = document.createElement('span');
                fileName.textContent = file.name;

                const removeButton = document.createElement('button');
                removeButton.textContent = 'clear';
                removeButton.className = 'remove-button';
                removeButton.addEventListener('click', function () {
                    const fileIndex = selectedFiles.indexOf(file);
                    if (fileIndex > -1) {
                        selectedFiles.splice(fileIndex, 1); // Remove file from selectedFiles
                        previewContainer.removeChild(previewItem); // Remove preview element
                    }
                });

                fileName.appendChild(removeButton); // Add removal button to file name
                previewItem.appendChild(previewContent);
                previewItem.appendChild(fileName);

                previewContainer.appendChild(previewItem);
            };

            fileReader.readAsDataURL(file);
        });
    });

    clearButton.addEventListener('click', function () {
        documentInput.value = ''; // Clear file input selection
        selectedFiles = [];
        previewContainer.innerHTML = ''; // Clear existing previews
    });

    // Helper function to return the appropriate icon based on file type
    function getFileIcon(fileType) {
        switch (fileType) {
            case 'pdf':
                return window.assetPaths.pdfIcon; // Replace with your icon path
            case 'doc':
            case 'docx': // Include 'docx' for Microsoft Word files
                return window.assetPaths.microsoftWordIcon; // Replace with your icon path
            case 'jpg':
            case 'jpeg':
            case 'png':
                return '/icons/image-icon.png'; // Replace with your icon path
            default:
                // return window.assetPaths.microsoftWordIcon; // Replace with a default icon path
        }
    }
});
