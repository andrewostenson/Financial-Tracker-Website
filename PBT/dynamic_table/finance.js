document.addEventListener('DOMContentLoaded', () => {
        updateChart();

    // Handle form submission for adding a new entry
    document.getElementById('addForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('../dynamic_table/add_row.php', {
            method: 'POST',
            body: formData
        })

        .then(response => response.json())
        .then(data => {
            if (data.success) {
                addRowToTable(data.row);
                this.reset();
                updateChart();
            }
            else {
                alert('Error adding entry');
            }
        });
    });

    // Handle delete button clicks
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-button')) {
            const id = e.target.closest('.delete-button').dataset.id;

            fetch('../dynamic_table/delete_row.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `id=${encodeURIComponent(id)}`
            })

            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    e.target.closest('tr').remove();
                    updateChart();
                } 
                else {
                    alert('Error deleting entry');
                }
            });
        }
    });
});

// Function to add a new row to the table
function addRowToTable(row) {
    const tBody = document.querySelector('.finance-table tbody');
    
    const tr = document.createElement('tr');
    tr.id = `row-${row.id}`;

    tr.innerHTML = `
        <td>${row.title}</td>
        <td>$${row.value}</td>
        <td>${row.date}</td>
        <td>
            <button class="delete-button" data-id="${row.id}">
                <img src="../images/deleteicon.png" class="table-icon" alt="Delete">
            </button>
        </td>
    `;

    tBody.appendChild(tr);
}