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
#mhj-table thead{background:linear-gradient(135deg,#ff512f,#dd2476);color:#fff}
#mhj-table tbody tr:hover{background:linear-gradient(135deg,#f8ffae,#43c6ac);color:#111;transition:.25s}

.action-link{display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:10px;transition:.25s}
.action-link:hover{transform:scale(1.08); background:rgba(0,0,0,.06)}
.badge-soft{background:#eef3ff;border:1px solid #e0e7ff;border-radius:999px;padding:.2rem .55rem}

/* checkbox column */
.select-cell{width:42px}
.form-check-input.round{border-radius:8px}
tfoot th{font-weight:800}
</style>

<div class="container mt-4">
  <!-- Header + Date picker -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="page-title mb-0">Mohajon SMS</h3>
    <div class="d-flex align-items-center gap-2">
      <label for="select-date" class="form-label mb-0">Select Date:</label>
      <input type="text" class="form-control datepicker" style="min-width:180px" id="select-date" name="select-date" placeholder="DD-MM-YYYY">
      <button id="show-btn" class="btn btn-gradient">Show</button>
    </div>
  </div>

  <!-- Table Card -->
  <div class="card fancy">
    <div class="card-header">
      <h5 class="mb-0"><i class="fa-solid fa-list-check me-2"></i> উপরোক্ত তারিখের মহাজনের হিসেব</h5>
    </div>
    <div class="card-body p-0">
      <div class="table-wrap">
        <table class="table table-striped mb-0" id="mhj-table">
          <thead>
            <tr>
              <th class="select-cell">
                <input class="form-check-input round" type="checkbox" id="chk-all" title="Select All">
              </th>
              <th>SL</th>
              <th>Option</th>
              <th>Mohajon</th>
              <th>Old Due</th>
              <th>Today Sell</th>
              <th>Paid</th>
              <th>Current Due</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            <!-- Demo rows: data-* এ কাঁচা সংখ্যা, UI-তে ফরম্যাটেড টেক্সট -->
            <tr
              data-name="Abdul Karim" data-mobile="01710000001"
              data-old="12500" data-sell="3500" data-paid="1500">
              <td><input class="form-check-input round row-chk" type="checkbox"></td>
              <td>1</td>
              <td>
                <a href="#" class="text-primary me-2 action-link send-message" title="Message"><i class="fa-regular fa-envelope"></i></a>
                <a href="#" class="text-success action-link send-whatsapp" title="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
              </td>
              <td class="td-name">Abdul Karim</td>
              <td class="td-old">—</td>
              <td class="td-sell">—</td>
              <td class="td-paid">—</td>
              <td class="td-current fw-bold">—</td>
              <td class="td-details"><p class="mb-0">—</p></td>
            </tr>

            <tr
              data-name="Rokeya Traders" data-mobile="01710000002"
              data-old="5400" data-sell="0" data-paid="1000">
              <td><input class="form-check-input round row-chk" type="checkbox"></td>
              <td>2</td>
              <td>
                <a href="#" class="text-primary me-2 action-link send-message" title="Message"><i class="fa-regular fa-envelope"></i></a>
                <a href="#" class="text-success action-link send-whatsapp" title="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
              </td>
              <td class="td-name">Rokeya Traders</td>
              <td class="td-old">—</td>
              <td class="td-sell">—</td>
              <td class="td-paid">—</td>
              <td class="td-current fw-bold">—</td>
              <td class="td-details"><p class="mb-0">—</p></td>
            </tr>

            <tr
              data-name="Mizan & Co" data-mobile="01710000003"
              data-old="0" data-sell="2200" data-paid="0">
              <td><input class="form-check-input round row-chk" type="checkbox"></td>
              <td>3</td>
              <td>
                <a href="#" class="text-primary me-2 action-link send-message" title="Message"><i class="fa-regular fa-envelope"></i></a>
                <a href="#" class="text-success action-link send-whatsapp" title="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
              </td>
              <td class="td-name">Mizan & Co</td>
              <td class="td-old">—</td>
              <td class="td-sell">—</td>
              <td class="td-paid">—</td>
              <td class="td-current fw-bold">—</td>
              <td class="td-details"><p class="mb-0">—</p></td>
            </tr>

            <tr
              data-name="Nur Nabi" data-mobile="01710000004"
              data-old="3100" data-sell="900" data-paid="1200">
              <td><input class="form-check-input round row-chk" type="checkbox"></td>
              <td>4</td>
              <td>
                <a href="#" class="text-primary me-2 action-link send-message" title="Message"><i class="fa-regular fa-envelope"></i></a>
                <a href="#" class="text-success action-link send-whatsapp" title="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
              </td>
              <td class="td-name">Nur Nabi</td>
              <td class="td-old">—</td>
              <td class="td-sell">—</td>
              <td class="td-paid">—</td>
              <td class="td-current fw-bold">—</td>
              <td class="td-details"><p class="mb-0">—</p></td>
            </tr>

          </tbody>
          <tfoot>
            <tr>
              <th colspan="4" class="text-end">Total:</th>
              <th id="ft-old">৳0</th>
              <th id="ft-sell">৳0</th>
              <th id="ft-paid">৳0</th>
              <th id="ft-current">৳0</th>
              <th>
                <button id="bulk-sms" class="btn btn-gradient btn-sm">Send Bulk SMS</button>
              </th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
    include 'partial/footer.php';
?>

<script>
// ===== Utilities =====
const BDT = (n)=>'৳'+Number(n||0).toLocaleString('en-US');
const num  = (x)=> Number(String(x||0).toString().replace(/[^0-9.-]/g,'')) || 0;

function initDatePicker(){
  if (typeof flatpickr !== 'undefined') { flatpickr('#select-date',{dateFormat:'d-m-Y'}); return; }
  if ($.fn.datepicker) { $('#select-date').datepicker({ dateFormat:'dd-mm-yy' }); return; }
}

function makeMessage({name,mobile,old,sell,paid,current}){
  // চাইলে এখানে প্রজেক্ট-স্ট্যান্ডার্ড টেমপ্লেট কাস্টমাইজ করো
  return `প্রিয় ${name}, আপনার বকেয়া ${BDT(current)} (পূর্বের: ${BDT(old)}, আজকের বিক্রয়: ${BDT(sell)}, পরিশোধ: ${BDT(paid)}). বিস্তারিত জানতে কল করুন ${mobile}। ধন্যবাদ।`;
}

function fillRowCalc($tr){
  const name   = $tr.data('name');
  const mobile = $tr.data('mobile');
  const old    = num($tr.data('old'));
  const sell   = num($tr.data('sell'));
  const paid   = num($tr.data('paid'));
  const current= old + sell - paid;

  // set UI text
  $tr.find('.td-old').text( BDT(old) );
  $tr.find('.td-sell').text( BDT(sell) );
  $tr.find('.td-paid').text( BDT(paid) );
  $tr.find('.td-current').text( BDT(current) );

  const msg = makeMessage({name,mobile,old,sell,paid,current});
  $tr.find('.td-details p').text(`ম্যাসেজ: ${msg}`);
  // button payload
  $tr.data('current', current);
  $tr.data('msg', msg);
}

function computeTotals(dtApi){
  let tOld=0, tSell=0, tPaid=0, tCur=0;

  dtApi.rows({page:'current'}).every(function(){
    const row = $(this.node());
    tOld  += num(row.data('old'));
    tSell += num(row.data('sell'));
    tPaid += num(row.data('paid'));
    // current might be computed; if not present, compute
    const cur = row.data('current')!=null ? row.data('current') : (num(row.data('old'))+num(row.data('sell'))-num(row.data('paid')));
    tCur  += num(cur);
  });

  $('#ft-old').text(BDT(tOld));
  $('#ft-sell').text(BDT(tSell));
  $('#ft-paid').text(BDT(tPaid));
  $('#ft-current').text(BDT(tCur));
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
  initDatePicker();

  // 1) প্রতি রো-তে হিসেব বসাও
  $('#mhj-table tbody tr').each(function(){ fillRowCalc($(this)); });

  // 2) DataTable init
  let dt;
  if ($.fn.DataTable) {
    dt = $('#mhj-table').DataTable({
      language:{
        search:"🔍 অনুসন্ধান:",
        lengthMenu:"_MENU_ রেকর্ড",
        zeroRecords:"কোনো তথ্য পাওয়া যায়নি",
        info:"মোট _TOTAL_ রেকর্ডের মধ্যে _START_–_END_",
        infoEmpty:"কোনো তথ্য নেই",
        paginate:{ previous:"⬅️", next:"➡️" }
      },
      columnDefs: [
        { targets:[0,2,8], orderable:false }, // checkbox, option, details
        { targets:[4,5,6,7], className:'text-end' }
      ],
      order:[[1,'asc']], // by SL
      drawCallback: function(){ computeTotals(this.api()); }
    });
    computeTotals(dt); // first time
  }

  // 3) Show button (demo)
  $('#show-btn').on('click', function(){
    const d = $('#select-date').val() || 'আজকের';
    Swal.fire({
      icon:'success',
      title:'ডাটা লোড হয়েছে!',
      text:`${d} মহাজন হিসেব সফলভাবে লোড হয়েছে।`,
      showConfirmButton:false, timer:1600
    });
  });

  // 4) Select all / row select
  $('#chk-all').on('change', function(){
    const c = $(this).is(':checked');
    $('.row-chk').prop('checked', c);
  });

  // 5) Single message
  $(document).on('click', '.send-message', function(e){
    e.preventDefault();
    const $tr = $(this).closest('tr');
    const name   = $tr.data('name') || 'Mohajon';
    const mobile = $tr.data('mobile') || '';
    const msg    = $tr.data('msg') || '';

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

    $(document).off('click.copyMsg').on('click.copyMsg', '#copyMsgBtn', function(){
      copyToClipboard($('#msgBox').val());
    });
    $(document).off('click.sentMsg').on('click.sentMsg', '#sendSmsBtn', function(){
      Swal.fire({ icon:'success', title:'সেন্ড করা হয়েছে (লগ মার্ক)', timer:1200, showConfirmButton:false });
    });
  });

  // 6) Single WhatsApp
  $(document).on('click', '.send-whatsapp', function(e){
    e.preventDefault();
    const $tr = $(this).closest('tr');
    const mobile = String($tr.data('mobile')||'').replace(/\D/g,'');
    const text   = $tr.data('msg') || '';
    if(!mobile){
      Swal.fire({ icon:'warning', title:'নম্বর নেই', text:'ভ্যালিড মোবাইল নম্বর পাওয়া যায়নি', timer:1400, showConfirmButton:false });
      return;
    }
    const url = `https://wa.me/${mobile}?text=${encodeURIComponent(text)}`;
    window.open(url,'_blank');
    Swal.fire({ icon:'info', title:'WhatsApp ওপেন', text:'নতুন ট্যাবে মেসেজ ওপেন হয়েছে', timer:1200, showConfirmButton:false });
  });

  // 7) Bulk SMS
  $('#bulk-sms').on('click', function(){
    const rows = $('#mhj-table tbody tr').has('.row-chk:checked');
    if(!rows.length){
      Swal.fire({ icon:'warning', title:'কেউ সিলেক্ট করা হয়নি', timer:1200, showConfirmButton:false });
      return;
    }
    let previewList = '';
    const payload = [];
    rows.each(function(i,el){
      const $tr = $(el);
      const name   = $tr.data('name');
      const mobile = $tr.data('mobile');
      const msg    = $tr.data('msg');
      previewList += `<li><strong>${name}</strong> (${mobile}) — ${msg}</li>`;
      payload.push({name, mobile, msg});
    });

    Swal.fire({
      title: `Bulk SMS (${payload.length})`,
      html: `<ol class="text-start" style="max-height:260px;overflow:auto">${previewList}</ol>
             <div class="mt-2 text-muted small">Send বাটনে ক্লিক করলে আপনার API-তে পাঠানো হবে (ডেমোতে শুধু কপি করা যাবে)।</div>`,
      showCancelButton:true,
      confirmButtonText:'Copy All',
      cancelButtonText:'Close'
    }).then(res=>{
      if(res.isConfirmed){
        const text = payload.map(p=>`${p.mobile}: ${p.msg}`).join('\n');
        copyToClipboard(text);
      }
    });

    // 👉 এখানে চাইলে AJAX POST করে তোমার SMS গেটওয়ে কল করবে
    // $.post('/api/sms/bulk', { list: payload }, function(res){ ... });
  });

  // 8) রিড্র-এ টোটাল রিক্যালক
  if (dt) {
    dt.on('draw', function(){ computeTotals(dt); });
  }

});
</script>
