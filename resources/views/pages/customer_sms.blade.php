<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>

<style>
/* 🌈 Gradient + Animated + Colorful */
.page-title{
  font-weight:800; letter-spacing:.3px;
  background:linear-gradient(135deg,#ff6a00,#ee0979);
  -webkit-background-clip:text; -webkit-text-fill-color:transparent;
  animation:fadeInDown .7s ease;
}
@keyframes fadeInDown{from{opacity:0;transform:translateY(-14px)}to{opacity:1;transform:translateY(0)}}

.card.fancy{
  border:0; border-radius:20px; overflow:hidden;
  box-shadow:0 12px 28px rgba(0,0,0,.12);
  animation:fadeInUp .8s ease;
  background:linear-gradient(135deg,#74ebd5,#9face6);
}
@keyframes fadeInUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}

.card.fancy .card-header{
  color:#fff; border:0;
  background:linear-gradient(135deg, #d3baecff, #463848ff);
}

.btn-gradient{
  background:linear-gradient(135deg,#36d1dc,#5b86e5);
  color:#fff!important; border:0; border-radius:12px; transition:.25s;
}
.btn-gradient:hover{transform:translateY(-1px) scale(1.02); box-shadow:0 10px 20px rgba(0,0,0,.18)}

.table-wrap{background:#fff;border-radius:18px;box-shadow:0 10px 24px rgba(0,0,0,.08);overflow:hidden}
#bc-table thead{background:linear-gradient(135deg,#ff512f,#dd2476);color:#fff}
#bc-table tbody tr:hover{background:linear-gradient(135deg,#f8ffae,#43c6ac);color:#111;transition:.25s}

.action-link{display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:10px;transition:.25s}
.action-link:hover{transform:scale(1.08); background:rgba(0,0,0,.06)}
.badge-soft{background:#eef3ff;border:1px solid #e0e7ff;border-radius:999px;padding:.2rem .55rem}
</style>

<div class="container mt-4">
  <!-- Header + Date picker -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="page-title mb-0">Customer SMS</h3>
    <div class="d-flex align-items-center gap-2">
      <label for="select-date" class="form-label mb-0">Select Date:</label>
      <input type="text" class="form-control datepicker" style="min-width:180px" id="select-date" name="select-date" placeholder="DD-MM-YYYY">
      <button id="show-btn" class="btn btn-gradient">Show</button>
    </div>
  </div>

  <!-- Table Card -->
  <div class="card fancy">
    <div class="card-header">
      <h5 class="mb-0"><i class="fa-solid fa-list-check me-2"></i> উপরোক্ত তারিখের বিক্রয় তালিকা</h5>
    </div>
    <div class="card-body p-0">
      <div class="table-wrap">
        <table class="table table-striped mb-0" id="bc-table">
          <thead>
            <tr>
              <th>SL</th>
              <th>Option</th>
              <th>Customer</th>
              <th>Old Due</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            <!-- Sample rows (trimmed columns) -->
            <tr>
              <td>1</td>
              <td>
                <a href="#" class="text-primary me-2 action-link send-message" title="Message"
                   data-customer="John Doe"
                   data-mobile="0123456789"
                   data-due="1200"
                   data-msg="আপনার বকেয়া টাকা ৳1,200। বিস্তারিত জানতে কল করুন 0123456789। ধন্যবাদ।">
                  <i class="fa-regular fa-envelope"></i>
                </a>
                <a href="#" class="text-success action-link send-whatsapp" title="WhatsApp"
                   data-mobile="0123456789"
                   data-text="আপনার বকেয়া টাকা ৳1,200। বিস্তারিত জানতে কল করুন 0123456789। ধন্যবাদ।">
                  <i class="fa-brands fa-whatsapp"></i>
                </a>
              </td>
              <td>John Doe</td>
              <td>৳1,200</td>
              <td>
                <p class="mb-0">তাকে এই ম্যাসেজ পাঠান: আপনার বকেয়া টাকা ৳1,200। বিস্তারিত জানতে কল করুন 0123456789। ধন্যবাদ।</p>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>
                <a href="#" class="text-primary me-2 action-link send-message" title="Message"
                   data-customer="Jane Smith"
                   data-mobile="0199999999"
                   data-due="800"
                   data-msg="আপনার বকেয়া টাকা ৳800। বিস্তারিত জানতে কল করুন 0199999999। ধন্যবাদ।">
                  <i class="fa-regular fa-envelope"></i>
                </a>
                <a href="#" class="text-success action-link send-whatsapp" title="WhatsApp"
                   data-mobile="0199999999"
                   data-text="আপনার বকেয়া টাকা ৳800। বিস্তারিত জানতে কল করুন 0199999999। ধন্যবাদ।">
                  <i class="fa-brands fa-whatsapp"></i>
                </a>
              </td>
              <td>Jane Smith</td>
              <td>৳800</td>
              <td>
                <p class="mb-0">তাকে এই ম্যাসেজ পাঠান: আপনার বকেয়া টাকা ৳800। বিস্তারিত জানতে কল করুন 0199999999। ধন্যবাদ।</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
    include 'partial/footer.php';
?>

<script>
// ===== Utility =====
function initDatePicker(){
  // Try flatpickr if present
  if (typeof flatpickr !== 'undefined') {
    flatpickr('#select-date', { dateFormat: 'd-m-Y' });
    return;
  }
  // Try jQuery UI datepicker if present
  if ($.fn.datepicker) {
    $('#select-date').datepicker({ dateFormat: 'dd-mm-yy' });
    return;
  }
}

function copyToClipboard(text){
  try{
    navigator.clipboard.writeText(text);
    Swal.fire({ icon:'success', title:'কপি হয়েছে', timer:900, showConfirmButton:false });
  }catch(e){
    const ta = document.createElement('textarea');
    ta.value = text; document.body.appendChild(ta);
    ta.select(); document.execCommand('copy'); document.body.removeChild(ta);
    Swal.fire({ icon:'success', title:'কপি হয়েছে', timer:900, showConfirmButton:false });
  }
}

$(document).ready(function(){
  // Datepicker init
  initDatePicker();

  // DataTable init (5 columns now)
  if ($.fn.DataTable) {
    $('#bc-table').DataTable({
      language:{
        search:"🔍 অনুসন্ধান:",
        lengthMenu:"_MENU_ রেকর্ড",
        zeroRecords:"কোনো তথ্য পাওয়া যায়নি",
        info:"মোট _TOTAL_ রেকর্ডের মধ্যে _START_–_END_",
        infoEmpty:"কোনো তথ্য নেই",
        paginate:{ previous:"⬅️", next:"➡️" }
      },
      columnDefs: [{ targets:[1,4], orderable:false }] // Option & Details not orderable
    });
  }

  // Show button (optional)
  $('#show-btn').on('click', function(){
    const d = $('#select-date').val() || 'আজকের';
    Swal.fire({
      icon: 'success',
      title: 'ডাটা লোড হয়েছে!',
      text: `${d} বিক্রয় তালিকা সফলভাবে লোড হয়েছে।`,
      showConfirmButton: false, timer: 1600
    });
  });

  // Message click -> SweetAlert with copy/send
  $(document).on('click', '.send-message', function(e){
    e.preventDefault();
    const name   = $(this).data('customer') || 'Customer';
    const mobile = $(this).data('mobile') || '';
    const due    = $(this).data('due') || '';
    const msg    = $(this).data('msg') || `আপনার বকেয়া টাকা ৳${due}। বিস্তারিত জানতে কল করুন ${mobile}। ধন্যবাদ।`;

    Swal.fire({
      title: `${name} - Message`,
      html: `
        <div class="text-start">
          <p class="mb-2"><strong>Mobile:</strong> ${mobile}</p>
          <textarea id="msgBox" class="form-control" rows="4">${msg}</textarea>
          <div class="mt-3 d-flex gap-2">
            <button type="button" id="copyMsgBtn" class="btn btn-gradient btn-sm">
              <i class="fa-regular fa-copy me-1"></i> Copy
            </button>
            <button type="button" id="sendSmsBtn" class="btn btn-outline-primary btn-sm">
              <i class="fa-regular fa-paper-plane me-1"></i> Mark as Sent
            </button>
          </div>
        </div>`,
      showConfirmButton:false
    });

    // Bind inside popup
    $(document).off('click.copyMsg').on('click.copyMsg', '#copyMsgBtn', function(){
      copyToClipboard($('#msgBox').val());
    });
    $(document).off('click.sentMsg').on('click.sentMsg', '#sendSmsBtn', function(){
      Swal.fire({ icon:'success', title:'সেন্ড করা হয়েছে (লগ মার্ক)', timer:1200, showConfirmButton:false });
    });
  });

  // WhatsApp click -> open wa.me
  $(document).on('click', '.send-whatsapp', function(e){
    e.preventDefault();
    const mobile = ($(this).data('mobile') || '').replace(/\D/g,'');
    const text   = $(this).data('text') || '';
    if(!mobile){
      Swal.fire({ icon:'warning', title:'নম্বর নেই', text:'ভ্যালিড মোবাইল নম্বর পাওয়া যায়নি', timer:1400, showConfirmButton:false });
      return;
    }
    const url = `https://wa.me/${mobile}?text=${encodeURIComponent(text)}`;
    window.open(url, '_blank');

    Swal.fire({ icon:'info', title:'WhatsApp ওপেন', text:'নতুন ট্যাবে মেসেজ ওপেন হয়েছে', timer:1200, showConfirmButton:false });
  });

});
</script>
