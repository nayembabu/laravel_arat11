@include('partials.header')
@include('partials.topmenu')
@include('partials.sidebar')


<!-- SweetAlert CSS & JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
/* Smooth hover effect for buttons */
.action-btn:hover {
    transform: scale(1.1);
    transition: 0.3s;
    cursor: pointer;
}

/* Product card hover animation */
#productCard .card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    transition: 0.4s;
}

/* Input focus style */
.form-control:focus {
    border-color: #ff6a88;
    box-shadow: 0 0 10px rgba(255,106,136,0.5);
}

/* Gradient Add Row Button */
#addRow {
    background: linear-gradient(90deg,#ff6a88,#ff99ac,#f6d365);
    color: #fff;
    font-weight: bold;
}

/* Gradient Check Button */
#productDetails .btn-warning {
    background: linear-gradient(135deg, #74ebd1ff,  #898b8eff);
    color: #fff;
}

/* Badge styling */
.badge {
    font-size: 0.9rem;
    padding: 0.5em 0.75em;
}

/* Card Titles */
.card-title {
    text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
}

/* Gradient sections for sales & cost */
#productDetails .card-body input {
    background: rgba(255,255,255,0.8);
}

/* Progress bar animation */
.progress {
    height: 6px;
    border-radius: 10px;
    overflow: hidden;
}
.progress-bar {
    background: linear-gradient(90deg,#ff6a88,#f6d365,#66a6ff);
    animation: progressAnim 2s ease-in-out forwards;
    width: 0;
}
@keyframes progressAnim {
    from {width:0;}
    to {width:100%;}
}
</style>

<div style="font-size: 24px;" class="container py-4">

  <!-- Product Selection -->
  <div class="row mb-4">
    <div class="col-md-6">
      <select id="productSelect" class="form-select select2">
        <option value="">-- পণ্য সিলেক্ট করুন --</option>
        <option value="rice">চাল</option>
        <option value="wheat">গম</option>
      </select>
    </div>
  </div>

  <!-- Gradient Buttons -->
  <div id="actionButtons" class="text-center d-none mb-4">
    <div class="p-3 rounded-pill shadow-lg" 
         style="background: linear-gradient(90deg,#ff6a88,#ff99ac,#f6d365);">
      <button class="btn btn-light fw-bold mx-2 action-btn">বিস্তারিত</button>
    </div>
  </div>

  <!-- Product Card -->
  <div id="productCard" class="d-none row justify-content-center mb-4">
    <div class="col-lg-4">
      <div class="card shadow-lg border-0 animate__animated animate__zoomIn"
           style="border-radius: 20px; background: linear-gradient(135deg,#89f7fe,#66a6ff); position:relative;">
        <div class="position-absolute top-0 end-0 m-2">
          <span class="badge bg-danger shadow">Qty: 6</span>
        </div>
        <img src="./images/alu.png"
             class="card-img-top rounded-top" alt="Product">
        <div class="card-body text-center text-white">
          <h5 class="card-title fw-bold">সেরা চাল</h5>
          <p class="fs-5">💰 দাম: 17 টাকা</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Product Details -->
  <div id="productDetails" class="d-none">
    <div class="card shadow-lg border-0 mb-4"
         style="border-radius: 18px; background: linear-gradient(135deg,#f7971e,#ffd200);">
      <div class="card-body text-dark">
        <h4 class="fw-bold mb-3">📊 বিক্রয়ের তথ্য</h4>
        <p><strong>বিক্রয়ের তারিখ:</strong> 2025-01-27</p>
        <p><strong>পরিমান:</strong> 6 বস্তা</p>
        <p><strong>মোট ওজন:</strong> 402 কেজি</p>
        <p><strong>দাম (প্রস্তাবিত):</strong> 17 টাকা</p>
        <p><strong>পন্যের কেনা দাম:</strong> 14.7944 টাকা</p>
      </div>
    </div>

    <div class="row">
      <!-- বিক্রয় ইনপুট -->
      <div class="col-lg-6 mb-4">
        <div class="card shadow-lg border-0"
             style="border-radius: 20px; background: linear-gradient(135deg,#43e97b,#38f9d7);">
          <div class="card-body">
            <h5 class="fw-bold text-white mb-3">📦 বিক্রয় তথ্য</h5>
            <div id="salesRows">
              <div class="row g-2 mb-2">
                <div class="col"><input type="text" class="form-control" placeholder="মোট বস্তা"></div>
                <div class="col"><input type="text" class="form-control" placeholder="ওজন"></div>
                <div class="col"><input type="text" class="form-control" placeholder="দাম"></div>
                <div class="col"><input type="text" class="form-control" placeholder="মোট দাম"></div>
                <div class="col-auto">
                  <button class="btn btn-danger btn-sm delete-row">ডিলিট</button>
                </div>
              </div>
            </div>
            <button id="addRow" class="btn w-100 shadow fw-bold">➕ আরও যোগ করুন</button>
          </div>
        </div>
      </div>

      <!-- খরচ ইনপুট -->
      <div class="col-lg-6 mb-4">
        <div class="card shadow-lg border-0"
             style="border-radius: 20px; background: linear-gradient(135deg,#a18cd1,#fbc2eb);">
          <div class="card-body">
            <h5 class="fw-bold text-white mb-3">💸 খরচের তথ্য</h5>
            <input type="text" class="form-control mb-2" placeholder="কমিশন">
            <input type="text" class="form-control mb-2" placeholder="তহুরী">
            <input type="text" class="form-control mb-2" placeholder="গদি খরচ">
            <input type="text" class="form-control mb-2" placeholder="ঘর গুলি খালি">
            <input type="text" class="form-control mb-2" placeholder="বস্তা ভাসানী">
            <input type="text" class="form-control mb-3" placeholder="অন্যান্য খরচ">
            <button class="btn btn-warning w-100 fw-bold shadow-lg" style="font-size:20px;" id="checkBtn">✅ চেক করুন</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Progress Bar -->
    <div class="progress mb-4 d-none" id="progressBar">
      <div class="progress-bar"></div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){

  // Select2 initialize
  $('.select2').select2({
    placeholder: "-- পণ্য সিলেক্ট করুন --",
  });

  // প্রোডাক্ট সিলেক্ট করলে বাটন দেখাও
  $('#productSelect').change(function(){
    if($(this).val()){
      $('#actionButtons').removeClass('d-none').addClass('animate__animated animate__fadeInDown');
    } else {
      $('#actionButtons').addClass('d-none');
      $('#productCard,#productDetails,#progressBar').addClass('d-none');
    }
  });

  // বাটন ক্লিকে প্রোডাক্ট কার্ড দেখাও
  $('.action-btn').click(function(){
    $('#productCard').removeClass('d-none').addClass('animate__animated animate__zoomIn');
  });

  // কার্ড ক্লিকে বিস্তারিত দেখাও
  $('#productCard').click(function(){
    $('#productDetails').removeClass('d-none').addClass('animate__animated animate__fadeInUp');
  });

  // বিক্রয় ইনপুটে নতুন রো যোগ
  $('#addRow').click(function(){
    let newRow = `
      <div class="row g-2 mb-2">
        <div class="col"><input type="text" class="form-control" placeholder="মোট বস্তা"></div>
        <div class="col"><input type="text" class="form-control" placeholder="ওজন"></div>
        <div class="col"><input type="text" class="form-control" placeholder="দাম"></div>
        <div class="col"><input type="text" class="form-control" placeholder="মোট দাম"></div>
        <div class="col-auto">
          <button class="btn btn-danger btn-sm delete-row">ডিলিট</button>
        </div>
      </div>`;
    $('#salesRows').append(newRow);
  });

  // ডিলিট রো
  $(document).on('click', '.delete-row', function(){
    $(this).closest('.row').remove();
  });

  // চেক করুন বাটন ক্লিক
  $('#checkBtn').click(function(){
    $('#progressBar').removeClass('d-none');
    $('.progress-bar').css('width','0');
    $('.progress-bar').animate({width:'100%'}, 1500, function(){
        Swal.fire({
          icon: 'success',
          title: 'সফলভাবে চেক করা হয়েছে!',
          text: 'আপনার ইনপুটগুলো সফলভাবে ভেরিফাই করা হয়েছে।',
          confirmButtonColor: '#ff6a88'
        });
        $('#progressBar').addClass('d-none');
    });
  });

});
</script>




@include('partials.footer')