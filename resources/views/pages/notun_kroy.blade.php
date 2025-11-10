@include('partials.header')
@include('partials.topmenu')
@include('partials.sidebar')

<div class="container mt-4">
  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light p-2 rounded shadow-sm">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">ক্রয়ের তালিকা</a></li>
      <li class="breadcrumb-item"><a href="#">নতুন ক্রয়</a></li>
      <li class="breadcrumb-item active" aria-current="page">ক্রয়</li>
    </ol>
  </nav>

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold text-gradient">🛒 ক্রয় (Purchase) – Add/Update Purchase</h3>
  </div>

  <form id="purchaseForm" class="card border-0 shadow-lg p-4 rounded-4 bg-gradient bg-light">
    <div class="row mb-3 align-items-end">
      <div class="col-md-5">
        <label for="supplier" class="form-label fw-semibold">সাপ্লাইয়ারের নাম</label>
        <div class="input-group">
            <button type="button" class="btn btn-primary add-btn" id="addSupplierBtn" title="Add New Supplier">
            <i class="fa fa-plus-circle me-1"></i> Add Supplier
          </button>
          <select id="supplier" name="supplier" class="form-select select2" style="width: 100%;" required>
            <option value="">সাপ্লাইয়ার সিলেক্ট করুন</option>
            <option value="option1">রহিম এন্টারপ্রাইজ</option>
            <option value="option2">করিম এন্টারপ্রাইজ</option>
            <option value="option2">রাফিদ এন্টারপ্রাইজ</option>
          </select>

        </div>
      </div>

      <div class="col-md-3">
        <label for="purchase_date" class="form-label fw-semibold">ক্রয় তারিখ</label>
        <input type="text" class="form-control" id="purchase_date" name="purchase_date" required>
      </div>

      <div class="col-md-4">
        <label for="lot_number" class="form-label fw-semibold">লট নং</label>
        <input type="text" class="form-control" id="lot_number" name="lot_number" placeholder="Lot Number">
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-8">
        <label for="product_select" class="form-label fw-semibold">পণ্য সিলেক্ট করুন</label>
        <select id="product_select" class="form-select select2" style="width: 100%;">
          <option value="">Select Product</option>
          <option value="aloo">আলু</option>
          <option value="morich">মরিচ</option>
          <option value="tomato">টমেটো</option>
        </select>
      </div>
    </div>

    <div class="table-responsive mb-3">
      <table class="table table-bordered align-middle text-center shadow-sm" id="purchaseItemsTable">
        <thead class="table-primary">
          <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>

    <div class="row mb-3">
      <div class="col-md-4 ms-auto">
        <div class="input-group">
          <span class="input-group-text fw-bold bg-primary text-white">Total</span>
          <input type="text" class="form-control text-end fw-bold" id="totalAmount" name="totalAmount" readonly value="0">
        </div>
      </div>
    </div>

    <div class="text-end">
      <button type="submit" class="btn btn-success px-4 py-2 fw-semibold">
        💾 Save Purchase
      </button>
    </div>
  </form>
</div>

<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content rounded-4 shadow-lg" id="addSupplierForm">
      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title" id="addSupplierModalLabel">➕ Add New Supplier</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="newSupplierName" class="form-label fw-semibold">সাপ্লাইয়ার এর নাম </label>
          <input type="text" class="form-control" id="newSupplierName" name="newSupplierName" placeholder="রহিম মিয়া " required>
        </div>
        <div class="mb-3">
          <label for="newSupplierMobile" class="form-label fw-semibold"> মোবাইল </label>
          <input type="text" class="form-control" id="newSupplierMobile" name="newSupplierMobile" placeholder="০১৮********" required>
        </div>
        <div class="mb-3">
          <label for="newSupplierCountry" class="form-label fw-semibold">দেশ</label>
          <input type="text" class="form-control" id="newSupplierCountry" name="newSupplierCountry" placeholder="বাংলাদেশ" required>
        </div>
        <div class="mb-3">
          <label for="newSupplierAddress" class="form-label fw-semibold">পুর্ণ ঠিকানা</label>
          <input type="text" class="form-control" id="newSupplierAddress" name="newSupplierAddress" placeholder="১২৩, যাত্রাবাড়ি, ঢাকা" required>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary px-4">Add Supplier</button>
      </div>
    </form>
  </div>
</div>

<script>
$(function() {
  // Initialize Select2 & Datepicker
  $('#supplier, #product_select').select2({ width: '100%', placeholder: 'Select...' });
  $('#purchase_date').datepicker({ dateFormat: 'dd-mm-yy' });

  // Add Supplier Button
  $('#addSupplierBtn').on('click', function() {
    $('#addSupplierModal').modal('show');
  });

  // Add New Supplier
  $('#addSupplierForm').on('submit', function(e) {
    e.preventDefault();
    let newSupplier = $('#newSupplierName').val().trim();
    if (newSupplier) {
      let newOption = new Option(newSupplier, newSupplier.toLowerCase(), true, true);
      $('#supplier').append(newOption).trigger('change');
      $('#addSupplierModal').modal('hide');
      $('#newSupplierName').val('');
      Swal.fire({
        icon: 'success',
        title: 'Supplier Added!',
        text: 'New supplier has been added successfully.',
        timer: 1500,
        showConfirmButton: false
      });
    }
  });

  // Product Add to Table
  $('#product_select').on('select2:select', function(e) {
    var productId = e.params.data.id;
    var productText = e.params.data.text;
    if($('#purchaseItemsTable tbody tr[data-product="'+productId+'"]').length === 0) {
      var row = `
        <tr data-product="${productId}">
          <td>${productText}</td>
          <td><input type="number" class="form-control qty" min="1" value="1"></td>
          <td><input type="number" class="form-control price" min="0" value="0"></td>
          <td class="total">0</td>
          <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button></td>
        </tr>`;
      $('#purchaseItemsTable tbody').append(row);
      calculateTotal();
    }
    $('#product_select').val(null).trigger('change');
  });

  // Row Remove & Total Update
  $('#purchaseItemsTable').on('click', '.remove-row', function() {
    $(this).closest('tr').remove();
    calculateTotal();
  });

  $('#purchaseItemsTable').on('input', '.qty, .price', function() {
    var row = $(this).closest('tr');
    var qty = parseFloat(row.find('.qty').val()) || 0;
    var price = parseFloat(row.find('.price').val()) || 0;
    row.find('.total').text((qty * price).toFixed(2));
    calculateTotal();
  });

  function calculateTotal() {
    var sum = 0;
    $('#purchaseItemsTable tbody tr').each(function() {
      sum += parseFloat($(this).find('.total').text()) || 0;
    });
    $('#totalAmount').val(sum.toFixed(2));
  }

  // Form Submit
  $('#purchaseForm').on('submit', function(e) {
    e.preventDefault();
    Swal.fire({
      icon: 'success',
      title: 'Saved!',
      text: 'Purchase Saved Successfully!',
      showConfirmButton: false,
      timer: 1500
    });
  });
});
</script>

<style>
.text-gradient {
  background: linear-gradient(45deg, #007bff, #00c4ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.add-btn {
  background: linear-gradient(45deg, #28a745, #20c997);
  color: #fff;
  transition: all 0.3s ease;
}
.add-btn:hover {
  transform: scale(1.05);
  background: linear-gradient(45deg, #20c997, #28a745);
}
.bg-gradient {
  background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);
}
.select2-container--default .select2-selection--single {
  height: 50px;
  border-radius: 0.375rem;
  border: 1px solid #ced4da;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
  line-height: 36px;
}
</style>

@include('partials.footer')
