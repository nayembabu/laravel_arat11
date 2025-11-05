<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>

<style>
/* 🌈 Gradient & Animated UI */
.page-title{
  font-weight:800; letter-spacing:.3px;
  background:linear-gradient(135deg,#ff6a00,#ee0979);
  -webkit-background-clip:text; -webkit-text-fill-color:transparent;
  animation:fadeInDown .7s ease;
}
@keyframes fadeInDown{from{opacity:0;transform:translateY(-16px)}to{opacity:1;transform:translateY(0)}}

.btn-gradient{
  background:linear-gradient(135deg,#36d1dc,#5b86e5);
  color:#fff!important; border:0; border-radius:12px; transition:.25s;
}
.btn-gradient:hover{transform:translateY(-1px) scale(1.02); box-shadow:0 10px 20px rgba(0,0,0,.18)}

.table-wrap{background:#fff;border-radius:18px;box-shadow:0 10px 24px rgba(0,0,0,.08);overflow:hidden}
#roleTable thead{background:linear-gradient(135deg,#ff512f,#dd2476);color:#fff}
#roleTable tbody tr:hover{background:linear-gradient(135deg,#f8ffae,#43c6ac);color:#111;transition:.25s}

/* Modal */
.modal-gradient .modal-content{border-radius:18px;overflow:hidden;border:0;box-shadow:0 12px 32px rgba(0,0,0,.2)}
.modal-gradient .modal-header{background:linear-gradient(135deg,#7f00ff,#e100ff);color:#fff}
</style>

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title mb-0">🛡️ All Roles</h2>
    <button id="openAddRoleBtn" class="btn btn-gradient">
      <i class="fa-solid fa-plus-circle me-1"></i> Add Role
    </button>
  </div>

  <!-- 📜 Roles Table -->
  <div class="table-wrap p-3">
    <table id="roleTable" class="display table table-hover align-middle w-100">
      <thead>
        <tr>
          <th>#</th>
          <th>Actions</th>
          <th>Role Name</th>
          <th>Responsibility</th>
          <th>Created</th>
        </tr>
      </thead>
      <tbody id="roleBody"></tbody>
    </table>
  </div>
</div>

<!-- 🧩 Add Role Modal -->
<div class="modal fade modal-gradient" id="addRoleModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa-solid fa-id-badge me-2"></i> নতুন Role যোগ করুন</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="modalCloseBtn"></button>
      </div>
      <div class="modal-body p-4">
        <form id="roleForm" class="row g-3">
          <div class="col-12">
            <label for="role_name" class="form-label">Role Name</label>
            <input type="text" id="role_name" class="form-control" placeholder="e.g., Admin, Manager" required>
          </div>
          <div class="col-12">
            <label for="role_desc" class="form-label">Responsibility / Description</label>
            <textarea id="role_desc" rows="3" class="form-control" placeholder="এই রোলের কাজ কী তা লিখুন..." required></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="cancelBtn">বাতিল</button>
        <button type="button" class="btn btn-gradient" id="saveRoleBtn">
          <i class="fa-solid fa-floppy-disk me-1"></i> সেভ করুন
        </button>
      </div>
    </div>
  </div>
</div>

<?php
    include 'partial/footer.php';
?>

<script>
let roles = [
  { id:1, name:"Admin", desc:"পুরো সিস্টেম ম্যানেজ করতে পারে।", created:"2025-10-01" },
  { id:2, name:"Editor", desc:"কনটেন্ট এডিট করতে পারে, কিন্তু সেটিংস পরিবর্তন করতে পারে না।", created:"2025-10-03" },
  { id:3, name:"Manager", desc:"ব্রাঞ্চের অর্ডার ও ইনভেন্টরি ম্যানেজ করে।", created:"2025-10-05" }
];

let dt;
let addModal;

// Helper
const todayISO = () => new Date().toISOString().slice(0,10);
const escapeHtml = str => str.replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[m]));
const makeRow = r => `
  <tr data-id="${r.id}">
    <td>${r.id}</td>
    <td>
      <button class="btn btn-sm btn-outline-primary view-btn"><i class="fa-regular fa-eye"></i></button>
      <button class="btn btn-sm btn-outline-danger ms-2 delete-btn"><i class="fa-solid fa-trash"></i></button>
    </td>
    <td class="c-name"><strong>${r.name}</strong></td>
    <td class="c-desc">${escapeHtml(r.desc)}</td>
    <td class="c-created">${r.created}</td>

  </tr>
`;

$(document).ready(function(){
  // Build table
  const tbody = $('#roleBody');
  roles.forEach(r => tbody.append(makeRow(r)));

  dt = $('#roleTable').DataTable({
    language:{
      search:"🔍 অনুসন্ধান:",
      lengthMenu:"_MENU_ টি Role",
      zeroRecords:"কোনো Role পাওয়া যায়নি",
      info:"মোট _TOTAL_ Role এর মধ্যে _START_–_END_",
      infoEmpty:"কোনো তথ্য নেই",
      paginate:{previous:"⬅️",next:"➡️"}
    },
    columnDefs:[{targets:[4], orderable:false}]
  });

  // Modal instance
  addModal = new bootstrap.Modal(document.getElementById('addRoleModal'));

  // Open modal
  $('#openAddRoleBtn').on('click', function(){
    $('#roleForm')[0].reset();
    Swal.fire({title:'Add Role', text:'নতুন Role যোগ করতে ফর্ম পূরণ করুন', icon:'info', timer:1200, showConfirmButton:false});
    addModal.show();
  });

  // Save Role
  $('#saveRoleBtn').on('click', function(){
    const name = $('#role_name').val().trim();
    const desc = $('#role_desc').val().trim();

    if(!name || !desc){
      Swal.fire('দুঃখিত','সব ফিল্ড পূরণ করুন','warning'); return;
    }

    const newRole = {
      id: roles.length ? Math.max(...roles.map(r=>r.id))+1 : 1,
      name, desc, created: todayISO()
    };
    roles.push(newRole);
    const $row = $(makeRow(newRole));
    dt.row.add($row).draw(false);

    addModal.hide();
    Swal.fire({title:'✅ সফলভাবে যুক্ত হয়েছে', text:`${name} রোলটি যোগ করা হয়েছে`, icon:'success', timer:1500, showConfirmButton:false});
  });

  // Cancel notification
  $('#cancelBtn, #modalCloseBtn').on('click', ()=>Swal.fire({title:'বাতিল করা হয়েছে',icon:'info',timer:900,showConfirmButton:false}));

  // View details
  $('#roleTable').on('click', '.view-btn', function(){
    const id = Number($(this).closest('tr').data('id'));
    const r = roles.find(x=>x.id===id);
    if(!r) return;
    Swal.fire({
      title: r.name,
      html:`<p class='text-start mb-0'><strong>Responsibility:</strong><br>${escapeHtml(r.desc)}</p><p class='text-end text-muted mt-2'>Created: ${r.created}</p>`,
      icon:'info', confirmButtonText:'ঠিক আছে'
    });
  });

  // Delete
  $('#roleTable').on('click', '.delete-btn', function(){
    const $tr = $(this).closest('tr');
    const id = Number($tr.data('id'));
    const r = roles.find(x=>x.id===id);
    if(!r) return;

    Swal.fire({
      title:'আপনি কি নিশ্চিত?',
      text:`${r.name} রোলটি মুছে ফেলতে চান?`,
      icon:'warning',
      showCancelButton:true,
      confirmButtonColor:'#d33', cancelButtonColor:'#3085d6',
      confirmButtonText:'হ্যাঁ, মুছে ফেলুন!', cancelButtonText:'না'
    }).then(res=>{
      if(res.isConfirmed){
        roles = roles.filter(x=>x.id!==id);
        dt.row($tr).remove().draw(false);
        Swal.fire('মুছে ফেলা হয়েছে!','রোল সফলভাবে মুছে ফেলা হয়েছে।','success');
      } else {
        Swal.fire({title:'বাতিল করা হয়েছে',icon:'info',timer:900,showConfirmButton:false});
      }
    });
  });
});
</script>
