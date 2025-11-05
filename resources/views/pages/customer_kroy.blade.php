<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>

<div class="container-fluid mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light px-3 py-2 rounded">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">ক্রয়ের তালিকা</a></li>
            <li class="breadcrumb-item"><a href="#">নতুন ক্রয়</a></li>
            <li class="breadcrumb-item active" aria-current="page">ক্রয়</li>
        </ol>
    </nav>

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">ক্রয় (Purchase) – Add/Update Purchase</h4>
    </div>

    <!-- Purchase Form -->
    <form id="purchaseForm" class="card p-4 shadow-sm">
        <div class="row mb-3 align-items-end">
            <!-- Supplier Select -->
            <div class="col-md-5">
                <label for="supplier" class="form-label">আমদানিকারকের নাম <span class="text-danger">*</span></label>
                <div class="input-group">
                    <select id="supplier" name="supplier" class="form-select" style="width: 100%;" required>
                        <option value="">Select</option>
                        <option value="1">Supplier A</option>
                        <option value="2">Supplier B</option>
                    </select>
                    <button type="button" class="btn btn-outline-success" id="addSupplierBtn" title="Add Supplier">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>
            </div>
            <!-- Purchase Date -->
            <div class="col-md-3">
                <label for="purchase_date" class="form-label">ক্রয় তারিখ</label>
                <input type="text" class="form-control" id="purchase_date" name="purchase_date" value="08-09-2025" autocomplete="off" required>
            </div>
            <!-- Lot Number -->
            <div class="col-md-4">
                <label for="lot_number" class="form-label">লট নং</label>
                <input type="text" class="form-control" id="lot_number" name="lot_number" placeholder="Lot Number">
            </div>
        </div>

        <!-- Product Selection -->
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="product_select" class="form-label">পণ্য সিলেক্ট করুন</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-upc-scan"></i></span>
                    <select id="product_select" class="form-select" style="width: 100%;">
                        <option value="">Select Product</option>
                        <option value="101">Product 1</option>
                        <option value="102">Product 2</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Purchase Items Table -->
        <div class="table-responsive mb-3">
            <table class="table table-bordered align-middle" id="purchaseItemsTable">
                <thead class="table-light">
                    <tr>
                        <th>পণ্য</th>
                        <th>পরিমাণ</th>
                        <th>দর</th>
                        <th>মোট</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamically added rows -->
                </tbody>
            </table>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Save Purchase</button>
        </div>
    </form>
</div>

<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" id="addSupplierForm">
      <div class="modal-header">
        <h5 class="modal-title" id="addSupplierModalLabel">Add New Supplier</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="new_supplier_name" class="form-label">Supplier Name</label>
          <input type="text" class="form-control" id="new_supplier_name" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Add</button>
      </div>
    </form>
  </div>
</div>



<script>
$(function() {
    // Select2 for supplier and product
    $('#supplier').select2({ placeholder: "Select", width: '100%' });
    $('#product_select').select2({ placeholder: "Select Product", width: '100%' });

    // Datepicker for purchase date
    $('#purchase_date').datepicker({
        dateFormat: 'dd-mm-yy'
    });

    // Add Supplier Modal
    $('#addSupplierBtn').on('click', function() {
        $('#addSupplierModal').modal('show');
    });

    $('#addSupplierForm').on('submit', function(e) {
        e.preventDefault();
        var newSupplier = $('#new_supplier_name').val().trim();
        if(newSupplier) {
            var newOption = new Option(newSupplier, newSupplier, true, true);
            $('#supplier').append(newOption).trigger('change');
            $('#addSupplierModal').modal('hide');
            $('#new_supplier_name').val('');
        }
    });

    // Add product to table
    $('#product_select').on('select2:select', function(e) {
        var productId = e.params.data.id;
        var productText = e.params.data.text;
        if(productId) {
            // Prevent duplicate
            if($('#purchaseItemsTable tbody tr[data-id="'+productId+'"]').length === 0) {
                var row = `
                    <tr data-id="${productId}">
                        <td>${productText}</td>
                        <td><input type="number" class="form-control form-control-sm qty" min="1" value="1"></td>
                        <td><input type="number" class="form-control form-control-sm price" min="0" value="0"></td>
                        <td class="total">0</td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="bi bi-trash"></i></button></td>
                    </tr>
                `;
                $('#purchaseItemsTable tbody').append(row);
            }
            // Reset product select
            $('#product_select').val(null).trigger('change');
        }
    });

    // Remove row
    $('#purchaseItemsTable').on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
    });

    // Calculate total on qty/price change
    $('#purchaseItemsTable').on('input', '.qty, .price', function() {
        var row = $(this).closest('tr');
        var qty = parseFloat(row.find('.qty').val()) || 0;
        var price = parseFloat(row.find('.price').val()) || 0;
        var total = qty * price;
        row.find('.total').text(total.toFixed(2));
    });

    // Form submit
    $('#purchaseForm').on('submit', function(e) {
        e.preventDefault();
        // Collect form data here and send to backend via AJAX or normal POST
        alert('Purchase saved (demo only)');
    });
});
</script>
             

<?php
    include 'partial/footer.php';
?>