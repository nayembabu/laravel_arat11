<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>



<div class="container mt-4">
    <h3>নতুন কাস্টমার যোগ</h3>
    <form id="customerForm" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="customerName" class="form-label">কাস্টমার নাম</label>
            <input type="text" class="form-control" id="customerName" required>
        </div>
        <div class="col-md-3">
            <label for="mobile" class="form-label">মোবাইল</label>
            <input type="text" class="form-control" id="mobile" required>
        </div>
        <div class="col-md-2">
            <label for="oldHishab" class="form-label">পুরাতন হিসাব</label>
            <input type="number" class="form-control" id="oldHishab" value="0" min="0" required>
        </div>
        <div class="col-md-4">
            <label for="address" class="form-label">ঠিকানা</label>
            <input type="text" class="form-control" id="address" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">কাস্টমার সংরক্ষণ করুন</button>
        </div>
    </form>

    <h4>কাস্টমার তালিকা</h4>
    <table id="customerTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>SL No</th>
                <th>কাস্টমার নাম</th>
                <th>মোবাইল</th>
                <th>ঠিকানা</th>
                <th>বাকী টাকা</th>
                <th>অপশন</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>0123456789</td>
                <td>123 Main St</td>
                <td>0</td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn" data-index="0">এডিট</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editCustomerForm" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCustomerModalLabel">কাস্টমার এডিট করুন</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row g-3">
        <input type="hidden" id="editIndex">
        <div class="col-md-6">
            <label for="editCustomerName" class="form-label">কাস্টমার নাম</label>
            <input type="text" class="form-control" id="editCustomerName" required>
        </div>
        <div class="col-md-6">
            <label for="editMobile" class="form-label">মোবাইল</label>
            <input type="text" class="form-control" id="editMobile" required>
        </div>
        <div class="col-md-6">
            <label for="editOldHishab" class="form-label">পুরাতন হিসাব</label>
            <input type="number" class="form-control" id="editOldHishab" min="0" required>
        </div>
        <div class="col-md-6">
            <label for="editAddress" class="form-label">ঠিকানা</label>
            <input type="text" class="form-control" id="editAddress" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">পরিবর্তন সংরক্ষণ করুন</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল করুন</button>
      </div>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
let customers = [];

function renderTable() {
    let tbody = '';
    customers.forEach((c, i) => {
        tbody += `<tr>
            <td>${i+1}</td>
            <td>${c.name}</td>
            <td>${c.mobile}</td>
            <td>${c.address}</td>
            <td>${c.due}</td>
            <td>
                <button class="btn btn-sm btn-warning editBtn" data-index="${i}">Edit</button>
            </td>
        </tr>`;
    });
    $('#customerTable tbody').html(tbody);
    $('#customerTable').DataTable().clear().destroy();
    $('#customerTable').DataTable({
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50, 100]
    });
}

$(document).ready(function() {
    renderTable();

    $('#customerForm').on('submit', function(e) {
        e.preventDefault();
        const name = $('#customerName').val().trim();
        const mobile = $('#mobile').val().trim();
        const due = $('#oldHishab').val().trim();
        const address = $('#address').val().trim();
        customers.push({ name, mobile, due, address });
        renderTable();
        this.reset();
    });

    $(document).on('click', '.editBtn', function() {
        const idx = $(this).data('index');
        const c = customers[idx];
        $('#editIndex').val(idx);
        $('#editCustomerName').val(c.name);
        $('#editMobile').val(c.mobile);
        $('#editOldHishab').val(c.due);
        $('#editAddress').val(c.address);
        var editModal = new bootstrap.Modal(document.getElementById('editCustomerModal'));
        editModal.show();
    });

    $('#editCustomerForm').on('submit', function(e) {
        e.preventDefault();
        const idx = $('#editIndex').val();
        customers[idx] = {
            name: $('#editCustomerName').val().trim(),
            mobile: $('#editMobile').val().trim(),
            due: $('#editOldHishab').val().trim(),
            address: $('#editAddress').val().trim()
        };
        renderTable();
        bootstrap.Modal.getInstance(document.getElementById('editCustomerModal')).hide();
    });
});
</script>


<?php
    include 'partial/footer.php';
?>