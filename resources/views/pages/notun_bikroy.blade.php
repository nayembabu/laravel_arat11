
<?php
include 'partial/header.php';
include 'partial/sidebar.php';
include 'partial/topmenu.php';
?>
<!-- Colorful, Gradient, Animated Sales Entry UI -->

<style>
  body {
    background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
    min-height: 100vh;
  }
  .card {
    border-radius: 18px;
    box-shadow: 0 4px 24px #6366f133;
    border: none;
    background: linear-gradient(120deg, #fff 80%, #e0e7ff 100%);
    transition: box-shadow .3s;
  }
  .card:hover { box-shadow: 0 8px 32px #6366f155; }
  .form-label { color: #6366f1; font-weight: 600; }
  .btn-primary, .btn-success {
    background: linear-gradient(90deg, #6366f1 0%, #a5b4fc 100%);
    border: none;
    font-weight: 600;
    letter-spacing: .5px;
    transition: background .2s;
  }
  .btn-primary:hover, .btn-success:hover {
    background: linear-gradient(90deg, #a5b4fc 0%, #6366f1 100%);
  }
  .select2-container--default .select2-selection--single {
    border-radius: 8px;
    border: 1px solid #c7d2fe;
    height: 38px;
    padding: 4px 8px;
    background: #f1f5f9;
  }
  .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #6366f1;
    font-weight: 500;
  }
  .step-card, .product-detail-section, .right-calc-section { display: none; }
  .product-card-selectable {
    cursor: pointer;
    transition: box-shadow .2s, transform .2s;
    border: 2px solid transparent;
    background: linear-gradient(120deg, #f1f5f9 80%, #c7d2fe 100%);
  }
  .product-card-selectable:hover {
    box-shadow: 0 0 18px #6366f155;
    border-color: #6366f1;
    transform: scale(1.03) rotate(-1deg);
  }
  .fade-in { animation: fadeIn .7s cubic-bezier(.4,0,.2,1); }
  @keyframes fadeIn { from { opacity:0; transform:translateY(30px);} to { opacity:1; transform:none;} }
  .gradient-bg {
    background: linear-gradient(90deg, #6366f1 0%, #a5b4fc 100%);
    color: #fff;
    border-radius: 12px 12px 0 0;
    padding: 18px 24px;
    font-size: 1.2rem;
    font-weight: 700;
    letter-spacing: .5px;
    box-shadow: 0 2px 8px #6366f122;
  }
  .right-calc-section { animation: slideInRight .7s cubic-bezier(.4,0,.2,1); }
  @keyframes slideInRight { from {opacity:0; transform:translateX(60px);} to {opacity:1; transform:none;} }
  .calc-label { color:#6366f1; font-weight:500; font-size:.98rem; }
  .calc-input {
    border-radius: 8px;
    border: 1px solid #c7d2fe;
    background: #f1f5f9;
    color: #374151;
    font-weight: 500;
    transition: border .2s;
  }
  .calc-input:focus { border-color:#6366f1; box-shadow:0 0 0 2px #6366f122; }
  .table th, .table td { border:none; padding:6px 10px; font-size:.98rem; }
  .table th { color:#6366f1; font-weight:600; background:#f1f5f9; }
  .table td { color:#374151; background:#fff; }
  .swal2-popup { border-radius:16px !important; }
</style>

<div class="container py-4">

  <!-- Step 1: Header Section -->
  <div class="card mb-4 fade-in">
    <div class="gradient-bg mb-3">
      <i class="fa fa-cart-plus me-2"></i> নতুন বিক্রয় এন্ট্রি
    </div>
    <div class="card-body row g-3 align-items-end">
      <div class="col-md-3">
        <label class="form-label">কাস্টমার নাম</label>
        <div class="input-group">
          <select class="form-select select2" id="customerSelect">
            <option value="">--Select Customer--</option>
            <option>Customer A</option>
            <option>Customer B</option>
          </select>
          <button class="btn btn-outline-primary" id="addCustomer"><i class="fa fa-user-plus"></i></button>
        </div>
      </div>
      <div class="col-md-3">
        <label class="form-label">বিক্রয়ের ধরন</label>
        <select class="form-select select2" id="saleType">
          <option>ডাইরেক্ট ১</option>
          <option>হোলসেল ২</option>
          <option>রিটেইল ৩</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label">বিক্রয় তারিখ</label>
        <input type="text" class="form-control datepicker" id="saleDate" value="DD-MM-YY">
      </div>
      <div class="col-md-3">
        <label class="form-label">পণ্য সিলেক্ট করুন</label>
        <select class="form-select select2" id="productSelect">
          <option value="onion">পেঁয়াজ (হায়দ্রাবাদী)</option>
          <option value="rice">চাল</option>
          <option value="oil">তেল</option>
        </select>
      </div>
    </div>
    <div class="text-end p-3">
      <button id="showStepCard" class="btn btn-primary d-none animate__animated animate__pulse">নতুন বিক্রয় যোগ করুন</button>
    </div>
  </div>

  <!-- Step 2: Product Card Section -->
  <div class="row step-card fade-in">
    <div class="col-lg-6">
      <div class="card product-card-selectable mb-3" id="productCard">
        <div class="card-body d-flex align-items-center">
          <div class="me-3" style="width:100px">
            <img src="https://via.placeholder.com/100/6366f1/fff?text=Product" alt="Product" style="border-radius:12px;box-shadow:0 2px 8px #6366f122;">
          </div>
          <div>
            <h5 id="prodName" style="color:#6366f1;font-weight:700;">পণ্য</h5>
            <p id="prodStock" style="color:#64748b;">Qty: --</p>
            <p id="prodPrice" style="color:#6366f1;font-weight:600;">Product Price: --</p>
          </div>
        </div>
      </div>
      <div class="text-center text-muted">কার্ডে ক্লিক করুন</div>
    </div>
  </div>

  <!-- Step 3: Product Details & Calculation Section -->
  <div class="row product-detail-section fade-in">
    <!-- Left: Product Details -->
    <div class="col-lg-6">
      <div class="card mb-3">
        <div class="gradient-bg mb-0" style="font-size:1rem;padding:12px 18px;">পণ্যের বিস্তারিত</div>
        <div class="card-body p-2">
          <table class="table table-sm mb-0">
            <tr><th>পণ্যের নাম</th><td id="detailName"></td></tr>
            <tr><th>স্টকে আছে</th><td id="detailStock"></td></tr>
            <tr><th>প্রতি কেজির ক্রয় দাম</th><td id="detailBuy"></td></tr>
            <tr><th>ক্রেডিট প্রতি খরচ</th><td id="detailCredit"></td></tr>
            <tr><th>প্রতি কেজির মোট দাম</th><td id="detailTotal"></td></tr>
            <tr><th>মোট কেজি ছিল</th><td id="detailTotalKg"></td></tr>
            <tr><th>১ বস্তায় ছিল</th><td id="detailBagKg"></td></tr>
          </table>
        </div>
      </div>
      <div class="card mb-3">
        <div class="card-body row g-2">
          <div class="col-md-4"><input type="number" class="form-control calc-input" placeholder="Qty"></div>
          <div class="col-md-4"><input type="number" class="form-control calc-input" placeholder="মোট কেজি"></div>
          <div class="col-md-4"><input type="number" class="form-control calc-input" placeholder="দাম"></div>
          <div class="col-12 text-end">
            <button class="btn btn-success btn-sm animate__animated animate__pulse">যোগ করুন</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Right: Calculation Section -->
    <div class="col-lg-6 right-calc-section">
      <div class="card">
        <div class="gradient-bg mb-0" style="font-size:1rem;padding:12px 18px;">হিসাব</div>
        <div class="card-body">
          <div class="mb-2"><label class="calc-label">মালেক দাম</label><input type="number" class="form-control calc-input"></div>
          <div class="mb-2"><label class="calc-label">লেবার খরচ</label><input type="number" class="form-control calc-input"></div>
          <div class="mb-2"><label class="calc-label">ঘাট/ভাড়া খরচ</label><input type="number" class="form-control calc-input"></div>
          <div class="mb-2"><label class="calc-label">বিক্রয় মার্জিন</label><input type="number" class="form-control calc-input"></div>
          <div class="mb-2"><label class="calc-label">ফেরত</label><input type="number" class="form-control calc-input"></div>
          <div class="mb-2"><label class="calc-label">সাবেক</label><input type="number" class="form-control calc-input"></div>
          <hr>
          <div class="mb-2"><label class="calc-label">মোট টাকা</label><input type="number" class="form-control calc-input" value="0"></div>
          <div class="mb-2"><label class="calc-label">জমা</label><input type="number" class="form-control calc-input"></div>
          <div class="mb-2"><label class="calc-label">বকেয়া</label><input type="number" class="form-control calc-input"></div>
          <div class="text-end mt-3">
            <button id="submitSale" class="btn btn-primary animate__animated animate__pulse">বিক্রয় করুন</button>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- Animate.css CDN for pulse effect -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<script>

$(document).ready(function() {
    // Initialize select2 for this specific element
    $('#saleType').select2({
        width: '100%',
        placeholder: 'বিক্রয়ের ধরন নির্বাচন করুন',
    });
});
document.getElementById('saleDate').valueAsDate = new Date();

$('#addCustomer').click(function(){
  Swal.fire('নতুন কাস্টমার যোগ করার অপশন খুলবে!');
});

// Ensure button state is correct on page load
$(document).ready(function() {
  checkStepReady();
});

// Step 1: Show button if product selected
function checkStepReady() {
  let prod = $('#productSelect').val();
  $('#showStepCard').toggleClass('d-none', !prod);
}
$('#productSelect').on('change', checkStepReady);

// Step 2: Show product card
$('#showStepCard').click(function(){
  $('.step-card').show().addClass('fade-in');
  let prod = $('#productSelect').val();
  if(prod === 'onion') {
    $('#prodName').text('পেঁয়াজ (হায়দ্রাবাদী)');
    $('#prodStock').text('Qty: 3 বস্তা');
    $('#prodPrice').text('Product Price: ৳ 60.90');
  } else if(prod === 'rice') {
    $('#prodName').text('চাল');
    $('#prodStock').text('Qty: 10 বস্তা');
    $('#prodPrice').text('Product Price: ৳ 55.00');
  } else if(prod === 'oil') {
    $('#prodName').text('তেল');
    $('#prodStock').text('Qty: 5 বস্তা');
    $('#prodPrice').text('Product Price: ৳ 180.00');
  }
  $('html,body').animate({scrollTop: $('.step-card').offset().top-30}, 400);
});

// Step 3: Show details on card click
$('#productCard').click(function(){
  let prod = $('#productSelect').val();
  if(prod === 'onion') {
    $('#detailName').text('পেঁয়াজ (হায়দ্রাবাদী)');
    $('#detailStock').text('3 বস্তা');
    $('#detailBuy').text('57.5 টাকা');
    $('#detailCredit').text('3.40 টাকা');
    $('#detailTotal').text('60.9000 টাকা');
    $('#detailTotalKg').text('280 কেজি');
    $('#detailBagKg').text('70 কেজি');
  } else if(prod === 'rice') {
    $('#detailName').text('চাল');
    $('#detailStock').text('10 বস্তা');
    $('#detailBuy').text('52.0 টাকা');
    $('#detailCredit').text('3.00 টাকা');
    $('#detailTotal').text('55.0000 টাকা');
    $('#detailTotalKg').text('500 কেজি');
    $('#detailBagKg').text('50 কেজি');
  } else if(prod === 'oil') {
    $('#detailName').text('তেল');
    $('#detailStock').text('5 বস্তা');
    $('#detailBuy').text('175.0 টাকা');
    $('#detailCredit').text('5.00 টাকা');
    $('#detailTotal').text('180.0000 টাকা');
    $('#detailTotalKg').text('200 লিটার');
    $('#detailBagKg').text('40 লিটার');
  }
  $('.product-detail-section').show().addClass('fade-in');
  $('.right-calc-section').show();
  $('html,body').animate({scrollTop: $('.product-detail-section').offset().top-30}, 400);
});

// Submit Sale Button
$('#submitSale').click(function(){
  Swal.fire({
    title: 'সফল!',
    text: 'বিক্রয় সম্পন্ন হয়েছে।',
    icon: 'success',
    confirmButtonText: 'ঠিক আছে'
  });
});
</script>

<?php
include 'partial/footer.php';
?>
