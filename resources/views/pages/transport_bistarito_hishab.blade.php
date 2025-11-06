@include('partials.header')
@include('partials.topmenu')
@include('partials.sidebar')



<style>
  /* 🌈 Gradient + Animated + Colorful + Mobile Friendly */
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

  .glass{
    backdrop-filter: blur(10px);
    background: rgba(255,255,255,.18);
    border:1px solid rgba(255,255,255,.2);
    border-radius:16px;
  }
  .label-soft{font-weight:600; opacity:.85}
  .hidden{display:none !important;}
  .section-title{
    font-weight:700; font-size:1.05rem; letter-spacing:.2px;
    background:linear-gradient(135deg,#00c6ff,#0072ff);
    -webkit-background-clip:text; -webkit-text-fill-color:transparent;
  }
  .btn-gradient{
    border:0; border-radius:14px; padding:.7rem 1rem; font-weight:700;
    background: linear-gradient(135deg,#ff512f,#dd2476);
    color:#fff; box-shadow:0 8px 20px rgba(221,36,118,.35);
    transition: transform .15s ease, box-shadow .15s ease;
  }
  .btn-gradient:hover{ transform: translateY(-2px); box-shadow:0 12px 24px rgba(221,36,118,.45); color:#fff}
  .pill{
    background:linear-gradient(135deg,#43e97b,#38f9d7);
    color:#033; padding:.3rem .7rem; border-radius:999px; font-weight:700; font-size:.8rem;
  }
  .form-control, .form-select{border-radius:12px}
  .select2-container--default .select2-selection--single{border-radius:12px;height:calc(2.5rem);padding:.3rem .5rem;border:1px solid rgba(0,0,0,.1)}
  .select2-selection__rendered{line-height:1.9rem}
  .select2-selection__arrow{top:7px !important}
  .table-card{border-radius:18px; overflow:hidden}
</style>

<div class="container-fluid py-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title mb-0">🚚 ট্রান্সপোর্ট হিসাব</h2>
  </div>

  <!-- Top Control Card -->
  <div class="card fancy p-3 mb-3">
    <div class="glass p-3">
      <div class="row g-3">
        <div class="col-12 col-md-6">
          <label class="form-label label-soft">ট্রান্সপোর্ট সিলেক্ট করুন</label>
          <select id="transportSelect" class="form-select select2" data-placeholder="ট্রান্সপোর্ট...">
            <option></option>
          </select>
        </div>
        <div class="col-12 col-md-6 hidden" id="customerSelectWrap">
          <label class="form-label label-soft">কাস্টমার সিলেক্ট করুন</label>
          <select id="customerSelect" class="form-select select2" data-placeholder="কাস্টমার...">
            <option></option>
          </select>
        </div>
      </div>
    </div>
  </div>

  <!-- Customer AutoFill + PAYMENT (top) + Date Range (below) -->
  <div class="card fancy p-3 mb-3 hidden" id="customerInfoCard">
    <div class="glass p-3">
      <div class="row g-3">
        <div class="col-12">
          <div class="section-title mb-2">👤 কাস্টমার তথ্য (Auto-Fill)</div>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
          <label class="form-label">নাম</label>
          <input type="text" id="cName" class="form-control" placeholder="নাম" readonly>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
          <label class="form-label">মোবাইল</label>
          <input type="text" id="cMobile" class="form-control" placeholder="মোবাইল" readonly>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
          <label class="form-label">বকেয়া</label>
          <input type="text" id="cDue" class="form-control" placeholder="বকেয়া" readonly>
        </div>
        <div class="col-12 col-md-6 col-xl-3">
          <label class="form-label">ঠিকানা</label>
          <input type="text" id="cAddress" class="form-control" placeholder="ঠিকানা" readonly>
        </div>

        <!-- 💸 Payment info ABOVE date-range -->
        <div class="col-12 mt-2">
          <div class="section-title mb-2">💸 পেমেন্ট তথ্য</div>
        </div>
        <div class="col-12 col-md-3">
          <label class="form-label">পেমেন্ট তারিখ</label>
          <input type="date" id="payDate" class="form-control"/>
        </div>
        <div class="col-12 col-md-3">
          <label class="form-label">পেমেন্ট সময়</label>
          <input type="time" id="payTime" class="form-control" step="60"/>
        </div>
        <div class="col-12 col-md-3">
          <label class="form-label">প্রদানের মাধ্যম</label>
          <select id="payMethod" class="form-select select2" data-placeholder="পদ্ধতি...">
            <option></option>
            <option value="cash">Cash</option>
            <option value="bkash">bKash</option>
            <option value="bank">Bank</option>
            <option value="nagad">Nagad</option>
          </select>
        </div>
        <div class="col-12 col-md-3">
          <label class="form-label">টাকার পরিমাণ</label>
          <input type="number" id="payAmount" class="form-control" placeholder="0" min="0" step="0.01">
        </div>
        <div class="col-12">
          <button id="payBtn" class="btn btn-gradient w-100">💥 টাকা দেন</button>
        </div>

        <!-- 📅 Date range SEARCH -->
        <div class="col-12 mt-2">
          <div class="section-title mb-2">📅 তারিখ থেকে তারিখ পর্যন্ত সার্চ</div>
        </div>
        <div class="col-12 col-md-4">
          <label class="form-label">From</label>
          <input type="date" id="fromDate" class="form-control">
        </div>
        <div class="col-12 col-md-4">
          <label class="form-label">To</label>
          <input type="date" id="toDate" class="form-control">
        </div>
        <div class="col-12 col-md-4 d-flex align-items-end">
          <button id="searchBtn" class="btn btn-gradient w-100">সার্চ</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Results Table -->
  <div class="card table-card p-2 mb-5 hidden" id="resultTableCard">
    <div class="p-3">
      <div class="d-flex align-items-center justify-content-between mb-2">
        <div class="section-title">📑 হিসাবের টেবিল</div>
        <span id="resultSummary" class="badge bg-dark-subtle text-dark-emphasis rounded-pill px-3 py-2"></span>
      </div>
      <div class="table-responsive">
        <table id="resultTable" class="table table-striped table-hover mb-0 w-100">
          <thead class="table-light">
            <tr>
              <th>সিরিয়াল</th>
              <th>তারিখ</th>
              <th>মহাজনের নাম</th>
              <th class="text-end">মোট বস্তা</th>
              <th class="text-end">রাস্তায় নামছে</th>
              <th class="text-end">আগের বকেয়া</th>
              <th class="text-end">ট্রান্সপোর্ট ভাড়া</th>
              <th class="text-end">ট্রান্সপোর্ট কমিশন</th>
              <th class="text-end">ড্রাইভার এডভান্স</th>
              <th class="text-end">বর্তমান বকেয়া</th>
            </tr>
          </thead>
          <tbody></tbody>
          <tfoot>
            <tr class="fw-bold">
              <td colspan="3" class="text-end">মোট</td>
              <td class="text-end" id="sumTotalBosta">0</td>
              <td class="text-end" id="sumRoadUnload">0</td>
              <td class="text-end" id="sumPrevDue">0</td>
              <td class="text-end" id="sumRent">0</td>
              <td class="text-end" id="sumCommission">0</td>
              <td class="text-end" id="sumAdvance">0</td>
              <td class="text-end" id="sumCurrentDue">0</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>



@include('partials.footer')

<script>
// ======== Demo Data (সার্ভার হলে AJAX দিয়ে আনবে) ========
const transports = [
  {id:'t1', text:'Sundarban Courier'},
  {id:'t2', text:'SA Paribahan'},
  {id:'t3', text:'Janani Express'}
];

const customersByTransport = {
  't1': [
    {id:'c101', name:'Rahim Traders', mobile:'017xxxxxxx1', due:12000, address:'Jatrabari, Dhaka'},
    {id:'c102', name:'Karim Store',   mobile:'018xxxxxxx2', due:4500,  address:'Cumilla'}
  ],
  't2': [
    {id:'c201', name:'Maya Enterprise', mobile:'019xxxxxxx3', due:0,    address:'Chittagong'},
    {id:'c202', name:'Alif Mart',       mobile:'016xxxxxxx4', due:7800, address:'Gazipur'}
  ],
  't3': [
    {id:'c301', name:'Bodol Tex', mobile:'015xxxxxxx5', due:3500, address:'Narayanganj'}
  ]
};

/*
  ✅ নতুন লেজার স্ট্রাকচার—টেবিল হেডারের সাথে ১:১ ম্যাপিং:
  {
    date: 'YYYY-MM-DD',
    mahajon: 'মহাজনের নাম',
    total_bosta: (number) মোট বস্তা,
    road_unload: (number) রাস্তায় নামছে,
    prev_due: (number) আগের বকেয়া,
    transport_rent: (number) ট্রান্সপোর্ট ভাড়া,
    transport_commission: (number) ট্রান্সপোর্ট কমিশন,
    driver_advance: (number) ড্রাইভার এডভান্স,
    current_due: (number) বর্তমান বকেয়া
  }
*/
const ledger = {
  'c101': [
    {date:'2025-10-01', mahajon:'Rahim Traders', total_bosta:120, road_unload:80, prev_due:10000, transport_rent:5000, transport_commission:600, driver_advance:1000, current_due:12000},
    {date:'2025-10-05', mahajon:'Rahim Traders', total_bosta:90,  road_unload:90, prev_due:12000, transport_rent:3800, transport_commission:450, driver_advance:500,  current_due:15000},
    {date:'2025-10-09', mahajon:'Rahim Traders', total_bosta:60,  road_unload:50, prev_due:15000, transport_rent:2500, transport_commission:300, driver_advance:0,    current_due:17000},
  ],
  'c102': [
    {date:'2025-10-02', mahajon:'Karim Store',   total_bosta:70,  road_unload:70, prev_due:4000,  transport_rent:2200, transport_commission:250, driver_advance:0,    current_due:4500},
  ],
  'c201': [
    {date:'2025-09-28', mahajon:'Maya Enterprise', total_bosta:55, road_unload:55, prev_due:0, transport_rent:1800, transport_commission:200, driver_advance:0, current_due:0},
  ],
  'c202': [
    {date:'2025-10-05', mahajon:'Alif Mart',     total_bosta:140, road_unload:120, prev_due:7000, transport_rent:5600, transport_commission:700, driver_advance:1000, current_due:7800},
  ],
  'c301': [
    {date:'2025-10-07', mahajon:'Bodol Tex',     total_bosta:95,  road_unload:90, prev_due:3000, transport_rent:3200, transport_commission:380, driver_advance:200, current_due:3500},
    {date:'2025-10-08', mahajon:'Bodol Tex',     total_bosta:80,  road_unload:80, prev_due:3500, transport_rent:2800, transport_commission:330, driver_advance:0,   current_due:3000},
  ],
};

// ======== Helpers ========
function setTodayDateTime(){
  const now=new Date();
  const yyyy=now.getFullYear();
  const mm=String(now.getMonth()+1).padStart(2,'0');
  const dd=String(now.getDate()).padStart(2,'0');
  const hh=String(now.getHours()).padStart(2,'0');
  const mi=String(now.getMinutes()).padStart(2,'0');
  $('#payDate').val(`${yyyy}-${mm}-${dd}`);
  $('#payTime').val(`${hh}:${mi}`);
  $('#fromDate').val(`${yyyy}-${mm}-01`);
  $('#toDate').val(`${yyyy}-${mm}-${dd}`);
}
function money(n){ return Number(n||0).toLocaleString('en-IN',{maximumFractionDigits:2}); }

$(document).ready(function(){
  // Init Select2
  $('#transportSelect').select2({data:transports, placeholder:$('#transportSelect').data('placeholder'), width:'100%'});
  $('#customerSelect').select2({placeholder:$('#customerSelect').data('placeholder'), width:'100%'});
  $('#payMethod').select2({placeholder:$('#payMethod').data('placeholder'), width:'100%'});

  setTodayDateTime();

  // DataTable init — order by তারিখ (কলাম #1), এবং সংখ্যাগুলো ডানদিকে
  const dt=$('#resultTable').DataTable({
    paging:true, searching:false, info:true, lengthChange:false, pageLength:5,
    order:[[1,'desc']],
    columnDefs:[
      {targets:[3,4,5,6,7,8,9], className:'text-end'}
    ]
  });

  // Transport change
  $('#transportSelect').on('change',function(){
    const tid=$(this).val();
    if(!tid){
      $('#customerSelectWrap, #customerInfoCard, #resultTableCard').addClass('hidden');
      $('#customerSelect').empty().trigger('change');
      dt.clear().draw();
      return;
    }
    const customers=customersByTransport[tid]||[];
    const opts=customers.map(c=>({id:c.id, text:`${c.name} — ${c.mobile}`}));
    $('#customerSelect').empty().select2({data:opts, placeholder:'কাস্টমার...', width:'100%'}).val(null).trigger('change');
    $('#customerSelectWrap').removeClass('hidden');
    $('#customerInfoCard, #resultTableCard').addClass('hidden');
    dt.clear().draw();
  });

  // Customer change -> autofill + show card
  $('#customerSelect').on('change',function(){
    const cid=$(this).val();
    if(!cid){ $('#customerInfoCard, #resultTableCard').addClass('hidden'); return; }
    const tid=$('#transportSelect').val();
    const customer=(customersByTransport[tid]||[]).find(c=>c.id===cid);
    if(customer){
      $('#cName').val(customer.name);
      $('#cMobile').val(customer.mobile);
      $('#cDue').val(money(customer.due));
      $('#cAddress').val(customer.address);
      setTodayDateTime(); // refresh payment date/time
      $('#customerInfoCard').removeClass('hidden');
    }
  });

  // Search -> fill table EXACTLY per columns
  $('#searchBtn').on('click',function(){
    const cid=$('#customerSelect').val();
    if(!cid){ Swal.fire({icon:'warning', title:'কাস্টমার সিলেক্ট করুন', timer:1600, showConfirmButton:false}); return; }
    const from=$('#fromDate').val(), to=$('#toDate').val();
    if(!from||!to){ Swal.fire({icon:'warning', title:'তারিখ রেঞ্জ দিন', timer:1600, showConfirmButton:false}); return; }

    const rows=(ledger[cid]||[]).filter(r=>r.date>=from && r.date<=to);
    dt.clear();

    let i=0,
        tTotalBosta=0, tRoadUnload=0, tPrevDue=0, tRent=0, tCommission=0, tAdvance=0, tCurrentDue=0;

    rows.forEach(r=>{
      i++;
      tTotalBosta   += Number(r.total_bosta||0);
      tRoadUnload   += Number(r.road_unload||0);
      tPrevDue      += Number(r.prev_due||0);
      tRent         += Number(r.transport_rent||0);
      tCommission   += Number(r.transport_commission||0);
      tAdvance      += Number(r.driver_advance||0);
      tCurrentDue   += Number(r.current_due||0);

      dt.row.add([
        i,
        r.date,
        r.mahajon || $('#cName').val() || '',
        Number(r.total_bosta||0).toLocaleString(),
        Number(r.road_unload||0).toLocaleString(),
        money(r.prev_due),
        money(r.transport_rent),
        money(r.transport_commission),
        money(r.driver_advance),
        money(r.current_due)
      ]);
    });

    dt.draw();

    // Footer sums
    $('#sumTotalBosta').text(Number(tTotalBosta).toLocaleString());
    $('#sumRoadUnload').text(Number(tRoadUnload).toLocaleString());
    $('#sumPrevDue').text(money(tPrevDue));
    $('#sumRent').text(money(tRent));
    $('#sumCommission').text(money(tCommission));
    $('#sumAdvance').text(money(tAdvance));
    $('#sumCurrentDue').text(money(tCurrentDue));

    $('#resultSummary').text(`${rows.length} টি রেকর্ড`);
    $('#resultTableCard').removeClass('hidden');

    Swal.fire({
      icon: rows.length ? 'success' : 'info',
      title: rows.length ? 'ডাটা লোড সম্পন্ন' : 'কোনো রেকর্ড নেই',
      text: rows.length ? `${from} থেকে ${to} পর্যন্ত` : 'অন্য তারিখ দিন চেষ্টা করুন',
      timer:1500, showConfirmButton:false
    });
  });

  // Pay
  $('#payBtn').on('click',function(){
    const cid=$('#customerSelect').val();
    const method=$('#payMethod').val();
    const amount=parseFloat($('#payAmount').val()||'0');
    const pDate=$('#payDate').val();
    const pTime=$('#payTime').val();

    if(!cid){ Swal.fire({icon:'warning', title:'কাস্টমার সিলেক্ট করুন', timer:1400, showConfirmButton:false}); return; }
    if(!method){ Swal.fire({icon:'warning', title:'প্রদানের মাধ্যম দিন', timer:1400, showConfirmButton:false}); return; }
    if(!(amount>0)){ Swal.fire({icon:'warning', title:'সঠিক টাকার পরিমাণ দিন', timer:1400, showConfirmButton:false}); return; }

    // TODO: এখানে AJAX দিয়ে সার্ভারে সেভ করুন
    // $.post('api/save_payment.php',{customer_id:cid, method, amount, pay_date:pDate, pay_time:pTime}).done(...)

    Swal.fire({
      icon:'success', title:'পেমেন্ট সফল!',
      html:`<div style="text-align:left">
        <div><b>Customer ID:</b> ${cid}</div>
        <div><b>Method:</b> ${method}</div>
        <div><b>Amount:</b> ${amount.toLocaleString()}</div>
        <div><b>Date & Time:</b> ${pDate} ${pTime}</div>
      </div>`,
      timer:1800, showConfirmButton:false
    });
    $('#payAmount').val('');
  });

  // Generic SweetAlert hook
  $(document).on('click','.swal-on-click',function(){
    Swal.fire({icon:'info', title:$(this).data('title')||'Clicked!', timer:1000, showConfirmButton:false});
  });
});
</script>
