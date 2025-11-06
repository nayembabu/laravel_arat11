@include('partials.header')
@include('partials.topmenu')
@include('partials.sidebar')



<div class="container mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">ক্রয়ের তালিকা</a></li>
            <li class="breadcrumb-item"><a href="#">নতুন ক্রয়</a></li>
            <li class="breadcrumb-item active" aria-current="page">ক্রয়</li>
        </ol>
    </nav>

    <!-- Page Title and User -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>ক্রয় (Purchase) – Add/Update Purchase</h3>
        <span class="badge bg-primary">Logged in as Admin</span>
    </div>

    <!-- Purchase Form -->
    <form id="purchaseForm" class="card p-4">
        <div class="row mb-3">
            <!-- Supplier/Importer Name -->
            <div class="col-md-5">
                <label for="supplier" class="form-label">আমদানিকারকের নাম</label>
                <div class="input-group">
                    <select id="supplier" name="supplier" class="form-select" style="width: 100%;" required>
                        <option value="">Select</option>
                        <!-- Dynamically load suppliers -->
                    </select>
                    <button type="button" class="btn btn-outline-secondary" id="addSupplierBtn" title="Add Supplier">
                        <i class="bi bi-plus"></i>
                    </button>
                </div>
            </div>
            <!-- Purchase Date -->
            <div class="col-md-3">
                <label for="purchase_date" class="form-label">ক্রয় তারিখ</label>
                <input type="text" class="form-control" id="purchase_date" name="purchase_date" value="08-09-2025" required>
            </div>
            <!-- Lot Number -->
            <div class="col-md-4">
                <label for="lot_number" class="form-label">লট নং</label>
                <input type="text" class="form-control" id="lot_number" name="lot_number" placeholder="Lot Number">
            </div>
        </div>

        <!-- Product Selection -->
        <div class="row mb-3">
            <div class="col-md-8">
                <label for="product_select" class="form-label">পণ্য সিলেক্ট করুন</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-upc-scan"></i></span>
                    <select id="product_select" class="form-select" style="width: 100%;">
                        <option value="">Select Product</option>
                        <!-- Dynamically load products -->
                    </select>
                </div>
            </div>
        </div>

        <!-- Purchase Items Table (dynamically generated) -->
        <div class="row mb-3">
            <div class="col-12">
                <table class="table table-bordered align-middle" id="purchaseItemsTable">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Product rows will be added here -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Total Amount -->
        <div class="row mb-3">
            <div class="col-md-4 ms-auto">
                <div class="input-group">
                    <span class="input-group-text">Total</span>
                    <input type="text" class="form-control" id="totalAmount" name="totalAmount" readonly value="0">
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="row">
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-success">Save Purchase</button>
            </div>
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
          <label for="newSupplierName" class="form-label">Supplier Name</label>
          <input type="text" class="form-control" id="newSupplierName" name="newSupplierName" required>
        </div>
        <!-- Add more fields as needed -->
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Supplier</button>
      </div>
    </form>
  </div>
</div>


<script>
$(function() {
    // Initialize Select2
    $('#supplier').select2({ placeholder: 'Select', width: '100%' });
    $('#product_select').select2({ placeholder: 'Select Product', width: '100%' });

    // Datepicker
    $('#purchase_date').datepicker({ dateFormat: 'dd-mm-yy' });

    // Add Supplier Modal 
    $('#addSupplierBtn').on('click', function() {
        $('#addSupplierModal').modal('show');
    });

    $('#addSupplierForm').on('submit', function(e) {
        e.preventDefault();
        var newSupplier = $('#newSupplierName').val();
        if(newSupplier) {
            var newOption = new Option(newSupplier, newSupplier, true, true);
            $('#supplier').append(newOption).trigger('change');
            $('#addSupplierModal').modal('hide');
            $('#newSupplierName').val('');
        }
    });

    // Product selection and adding to table
    $('#product_select').on('select2:select', function(e) {
        var productId = e.params.data.id;
        var productText = e.params.data.text;
        if(productId) {
            // Prevent duplicate
            if($('#purchaseItemsTable tbody tr[data-product="'+productId+'"]').length === 0) {
                var row = `<tr data-product="${productId}">
                    <td>${productText}</td>
                    <td><input type="number" class="form-control qty" min="1" value="1"></td>
                    <td><input type="number" class="form-control price" min="0" value="0"></td>
                    <td class="total">0</td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="bi bi-trash"></i></button></td>
                </tr>`;
                $('#purchaseItemsTable tbody').append(row);
            }
            $('#product_select').val(null).trigger('change');
            calculateTotal();
        }
    });

    // Remove row
    $('#purchaseItemsTable').on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
        calculateTotal();
    });

    // Quantity/Price change
    $('#purchaseItemsTable').on('input', '.qty, .price', function() {
        var row = $(this).closest('tr');
        var qty = parseFloat(row.find('.qty').val()) || 0;
        var price = parseFloat(row.find('.price').val()) || 0;
        var total = qty * price;
        row.find('.total').text(total.toFixed(2));
        calculateTotal();
    });

    function calculateTotal() {
        var sum = 0;
        $('#purchaseItemsTable tbody tr').each(function() {
            var rowTotal = parseFloat($(this).find('.total').text()) || 0;
            sum += rowTotal;
        });
        $('#totalAmount').val(sum.toFixed(2));
    }

    // Form submit
    $('#purchaseForm').on('submit', function(e) {
        e.preventDefault();
        // Collect form data and send via AJAX or normal POST as needed
        alert('Purchase saved (demo only)');
    });

    // Demo: Populate suppliers and products
    var suppliers = ['Supplier A', 'Supplier B', 'Supplier C'];
    suppliers.forEach(function(s) {
        $('#supplier').append(new Option(s, s));
    });
    var products = [
        {id: '1', text: 'Product 1'},
        {id: '2', text: 'Product 2'},
        {id: '3', text: 'Product 3'}
    ];
    products.forEach(function(p) {
        $('#product_select').append(new Option(p.text, p.id));
    });
});
</script>

             



@include('partials.footer')