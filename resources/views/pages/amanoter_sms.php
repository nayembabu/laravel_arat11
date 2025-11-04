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
  background:linear-gradient(135deg,#8e2de2,#4a00e0);
}

.btn-gradient{
  background:linear-gradient(135deg,#36d1dc,#5b86e5);
  color:#fff!important; border:0; border-radius:12px; transition:.25s;
}
.btn-gradient:hover{transform:translateY(-1px) scale(1.02); box-shadow:0 10px 20px rgba(0,0,0,.18)}

.table-wrap{background:#fff;border-radius:18px;box-shadow:0 10px 24px rgba(0,0,0,.08);overflow:hidden}
#bc-table thead{background:linear-gradient(135deg,#ff512f,#dd2476);color:#fff}
#bc-table tbody tr:hover{background:linear-gradient(135deg,#f8ffae,#43c6ac);color:#111;transition:.25s}

.fade-in{animation:fadeIn .4s ease}
@keyframes fadeIn{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}
</style>

<div class="container mt-4">
    <div class="row mb-4 align-items-center">
        <div class="col-auto">
            <label for="select-date" class="form-label mb-0 fw-bold">Select Date:</label>
        </div>
        <div class="col-auto">
            <input type="text" class="form-control datepicker" id="select-date" name="select-date" placeholder="DD-MM-YYYY">
        </div>
        <div class="col-auto">
            <button id="show-btn" class="btn btn-gradient px-4">Show</button>
        </div>
    </div>

    <div class="card fancy d-none" id="data-card">
        <div class="card-header">
            <h3 class="mb-0"><i class="fa-solid fa-list-check me-2"></i>উপরোক্ত তারিখের আমানতের তালিকা</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-wrap">
                <table class="table table-striped mb-0" id="bc-table" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Option</th>
                            <th>Person</th>
                            <th>Old Hishab</th>
                            <th>Today's Hishab</th>
                            <th>Marfot</th>
                            <th>Running Total</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
    include 'partial/footer.php';
?>

<script>
$(document).ready(function() {

    // ✅ Initialize datepicker
    if (typeof flatpickr !== 'undefined') {
        flatpickr('#select-date', { dateFormat: 'd-m-Y' });
    } else if ($.fn.datepicker) {
        $('#select-date').datepicker({ dateFormat: 'dd-mm-yy' });
    }

    // 🧩 Mock Data
    const MOCK_DATA = [
        { date:'10-10-2025', name:'John Doe', mobile:'01711111111', old:1200, today:5000, marfot:'সে এই বাবদ ৫০০০ নিছিলো', total:6200 },
        { date:'10-10-2025', name:'Jane Smith', mobile:'01822222222', old:800, today:2000, marfot:'আজ ২০০০ জমা দিয়েছে', total:2800 },
        { date:'09-10-2025', name:'Rafi Khan', mobile:'01933333333', old:1000, today:3000, marfot:'গতকাল ৩০০০ দিয়েছিল', total:4000 },
    ];

    let table = null;

    // 🧠 Render Table Function
    function renderTable(data) {
        const tbody = $("#bc-table tbody");
        tbody.empty();

        if (!data.length) {
            tbody.append(`<tr><td colspan="7" class="text-center text-muted py-4">কোনো তথ্য পাওয়া যায়নি</td></tr>`);
            return;
        }

        data.forEach((item, i) => {
            const msg = `প্রিয় ${item.name}, আপনার মোট বকেয়া ৳${item.total}। বিস্তারিত জানতে কল করুন ${item.mobile}। ধন্যবাদ।`;
            tbody.append(`
                <tr class="fade-in">
                    <td>${i+1}</td>
                    <td>
                        <a href="#" class="text-primary me-2 send-message" 
                           data-name="${item.name}" data-mobile="${item.mobile}" 
                           data-msg="${msg}" title="Message">
                           <i class="fa-regular fa-envelope"></i>
                        </a>
                        <a href="#" class="text-success send-whatsapp" 
                           data-mobile="${item.mobile}" data-text="${msg}" title="WhatsApp">
                           <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    </td>
                    <td>${item.name}</td>
                    <td>৳${item.old}</td>
                    <td>৳${item.today}</td>
                    <td>${item.marfot}</td>
                    <td>৳${item.total}</td>
                </tr>
            `);
        });

        // Init/Refresh DataTable
        if ($.fn.DataTable) {
            if (table) table.clear().destroy();
            table = $('#bc-table').DataTable({
                language:{
                    search:"🔍 অনুসন্ধান:",
                    lengthMenu:"_MENU_ রেকর্ড",
                    zeroRecords:"কোনো তথ্য পাওয়া যায়নি",
                    info:"মোট _TOTAL_ রেকর্ডের মধ্যে _START_–_END_",
                    infoEmpty:"কোনো তথ্য নেই",
                    paginate:{ previous:"⬅️", next:"➡️" }
                }
            });
        }
    }

    // 🎯 Show Button Click
    $("#show-btn").on("click", function() {
        const selectedDate = $("#select-date").val().trim();
        if(!selectedDate){
            Swal.fire({ icon:'warning', title:'তারিখ দিন!', timer:1500, showConfirmButton:false });
            return;
        }

        const filtered = MOCK_DATA.filter(x => x.date === selectedDate);
        $("#data-card").removeClass("d-none").addClass("fade-in");
        renderTable(filtered);

        Swal.fire({
            icon: filtered.length ? 'success' : 'info',
            title: filtered.length ? 'ডাটা লোড হয়েছে!' : 'কোনো ডাটা পাওয়া যায়নি',
            text: `${selectedDate} তারিখের রেকর্ড`,
            showConfirmButton: false,
            timer: 1600
        });
    });

    // ✉️ Message Button Click
    $(document).on('click', '.send-message', function(e){
        e.preventDefault();
        const name   = $(this).data('name');
        const mobile = $(this).data('mobile');
        const msg    = $(this).data('msg');

        Swal.fire({
            title: `${name} - Message`,
            html: `
                <div class="text-start">
                    <p><strong>Mobile:</strong> ${mobile}</p>
                    <textarea id="msgBox" class="form-control" rows="4">${msg}</textarea>
                    <div class="mt-3 d-flex gap-2">
                        <button type="button" id="copyMsgBtn" class="btn btn-gradient btn-sm">
                            <i class="fa-regular fa-copy me-1"></i> Copy
                        </button>
                        <button type="button" id="sentBtn" class="btn btn-outline-primary btn-sm">
                            <i class="fa-regular fa-paper-plane me-1"></i> Mark Sent
                        </button>
                    </div>
                </div>`,
            showConfirmButton:false
        });

        // Copy button
        $(document).off('click.copyMsg').on('click.copyMsg','#copyMsgBtn',function(){
            const text = $('#msgBox').val();
            navigator.clipboard.writeText(text);
            Swal.fire({icon:'success',title:'কপি সম্পন্ন!',timer:1000,showConfirmButton:false});
        });

        // Sent mark
        $(document).off('click.sentMsg').on('click.sentMsg','#sentBtn',function(){
            Swal.fire({icon:'success',title:'সেন্ড মার্কড!',timer:1000,showConfirmButton:false});
        });
    });

    // 🟢 WhatsApp Button Click
    $(document).on('click', '.send-whatsapp', function(e){
        e.preventDefault();
        const mobile = $(this).data('mobile').replace(/\D/g,'');
        const text   = $(this).data('text');
        if(!mobile){
            Swal.fire({icon:'warning',title:'নম্বর নেই!',timer:1200,showConfirmButton:false});
            return;
        }
        const url = `https://wa.me/${mobile}?text=${encodeURIComponent(text)}`;
        window.open(url, '_blank');
        Swal.fire({icon:'info',title:'WhatsApp ওপেন হয়েছে!',timer:1000,showConfirmButton:false});
    });

});
</script>
