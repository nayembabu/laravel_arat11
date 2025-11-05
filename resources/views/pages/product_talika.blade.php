<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>

<!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Product List</h2>
        <button id="deleteSelected" class="btn btn-danger btn-sm d-none">Delete Selected</button>
    </div>

    <table class="table table-bordered" id="productTable">
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Unit</th>
                <th>Options</th>
                <th><input type="checkbox" id="selectAll"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>PRD001</td>
                <td>Rice</td>
                <td>
                    <select class="form-select">
                        <option>Kg</option>
                        <option>Bags</option>
                        <option>Baskets</option>
                    </select>
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="showEditCard(this)">Edit</button>
                </td>
                <td><input type="checkbox" class="row-select"></td>
            </tr>
            <tr>
                <td>PRD002</td>
                <td>Wheat</td>
                <td>
                    <select class="form-select">
                        <option>Kg</option>
                        <option>Bags</option>
                        <option>Baskets</option>
                    </select>
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="showEditCard(this)">Edit</button>
                </td>
                <td><input type="checkbox" class="row-select"></td>
            </tr>
            <tr>
                <td>PRD003</td>
                <td>Sugar</td>
                <td>
                    <select class="form-select">
                        <option>Kg</option>
                        <option>Bags</option>
                        <option>Baskets</option>
                    </select>
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="showEditCard(this)">Edit</button>
                </td>
                <td><input type="checkbox" class="row-select"></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Edit Card Modal -->
<div class="modal fade" id="editCardModal" tabindex="-1" aria-labelledby="editCardModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCardModalLabel">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editProductForm">
            <input type="hidden" id="editingRowIndex">
            <div class="mb-3">
                <label class="form-label">বস্তু সংকেত</label>
                <input type="text" class="form-control" id="editCode">
            </div>
            <div class="mb-3">
                <label class="form-label">আইটেম নাম</label>
                <input type="text" class="form-control" id="editName">
            </div>
            <div class="mb-3">
                <label class="form-label">একক</label>
                <select class="form-select" id="editUnit">
                    <option>Kg</option>
                    <option>Bags</option>
                    <option>Baskets</option>
                    <option>Liters</option>
                    <option>Bottles</option>
                    <option>Cans</option>
                    <option>Packets</option>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
      </div>
    </div>
  </div>
</div>



<script>
let currentRow = null;

function showEditCard(btn) {
    currentRow = btn.closest("tr");
    document.getElementById('editCode').value = currentRow.cells[0].innerText;
    document.getElementById('editName').value = currentRow.cells[1].innerText;
    document.getElementById('editUnit').value = currentRow.cells[2].querySelector("select").value;

    var editModal = new bootstrap.Modal(document.getElementById('editCardModal'));
    editModal.show();
}

// Save changes and update row + Toastr notification
document.getElementById("saveChangesBtn").addEventListener("click", function() {
    if (currentRow) {
        currentRow.cells[0].innerText = document.getElementById('editCode').value;
        currentRow.cells[1].innerText = document.getElementById('editName').value;
        currentRow.cells[2].querySelector("select").value = document.getElementById('editUnit').value;

        // Close modal
        bootstrap.Modal.getInstance(document.getElementById('editCardModal')).hide();

        // Toastr success notification
        toastr.success("Product updated successfully!", "Success");
    }
});

// Select/Deselect all checkboxes + show delete button
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('selectAll');
    const rowCheckboxes = document.querySelectorAll('.row-select');
    const deleteBtn = document.getElementById('deleteSelected');

    function toggleDeleteButton() {
        const anyChecked = Array.from(rowCheckboxes).some(cb => cb.checked);
        deleteBtn.classList.toggle('d-none', !anyChecked);
    }

    selectAll.addEventListener('change', function() {
        rowCheckboxes.forEach(cb => cb.checked = this.checked);
        toggleDeleteButton();
    });

    rowCheckboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            if (!this.checked) selectAll.checked = false;
            toggleDeleteButton();
        });
    });

    deleteBtn.addEventListener('click', function() {
        rowCheckboxes.forEach(cb => {
            if (cb.checked) cb.closest('tr').remove();
        });
        selectAll.checked = false;
        toggleDeleteButton();
        toastr.info("Selected products deleted!", "Deleted");
    });
});
</script>

<?php
    include 'partial/footer.php';
?>
