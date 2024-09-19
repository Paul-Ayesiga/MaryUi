document.addEventListener('DOMContentLoaded', () => {
    // Access edit buttons using PowerGrid's class selector
    const editButtons = document.querySelectorAll('.powergrid-edit-button');

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const rowData = JSON.parse(button.dataset.row); // Assuming row data is JSON-encoded
            const modal = document.getElementById('edit_Loan');
            const modalContent = modal.querySelector('.modal-content');

            // Populate modal content with rowData
            modalContent.innerHTML = `
                <p>Name: ${rowData.name}</p>
                `;

            modal.style.display = 'block';
        });
    });
});
