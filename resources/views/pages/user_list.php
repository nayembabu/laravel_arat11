<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>

<style>
/* 🌈 Gradient & Animated UI */
.page-title {
    font-weight: 700;
    background: linear-gradient(135deg, #ff6a00, #ee0979);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: fadeInDown 1s ease;
}
@keyframes fadeInDown { from {opacity:0; transform: translateY(-20px);} to {opacity:1; transform: translateY(0);} }

/* 🟣 Fancy Card Style */
.user-card {
    background: linear-gradient(135deg, #74ebd5, #9face6);
    border-radius: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    padding: 20px;
    animation: fadeInUp 1s ease;
}
@keyframes fadeInUp { from {opacity:0; transform: translateY(20px);} to {opacity:1; transform: translateY(0);} }

/* 🌟 Table Enhancement */
#userTable { border-radius: 15px; overflow: hidden; background-color: #fff; }
#userTable thead { background: linear-gradient(135deg, #ff512f, #dd2476); color: #fff; }
#userTable tbody tr:hover { background: linear-gradient(135deg, #f8ffae, #43c6ac); color: #111; transition: 0.3s; }

/* 🎨 Buttons */
.btn-gradient {
    background: linear-gradient(135deg, #36d1dc, #5b86e5);
    color: white !important;
    border: none;
    border-radius: 12px;
    transition: 0.3s;
}
.btn-gradient:hover { transform: scale(1.05); box-shadow: 0 4px 10px rgba(0,0,0,0.2); }

/* ⚡ Sweet hover animation */
.action-btn { border-radius: 10px; transition: all 0.3s ease; }
.action-btn:hover { transform: scale(1.1); }

/* Modal styling */
.modal-gradient .modal-content {
    border-radius: 18px;
    overflow: hidden;
    border: 0;
    box-shadow: 0 10px 30px rgba(0,0,0,.2);
}
.modal-gradient .modal-header {
    background: linear-gradient(135deg, #7f00ff, #e100ff);
    color: #fff;
}
</style>

<div class="container mt-4 animate__animated animate__fadeIn">
    <div class="user-card mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="page-title mb-0">👥 ব্যবহারকারীর তালিকা</h2>
            <a href="new_user.php" class="btn btn-gradient">
               <i class="fa-solid fa-user-plus"></i>  ব্যবহারকারী যোগ করুন
            </a>
        </div>
    </div>

    <div class="table-responsive animate__animated animate__fadeInUp">
        <table id="userTable" class="display table table-striped table-hover text-center align-middle w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Action</th>
                    <th>নাম</th>
                    <th>ইমেইল</th>
                    <th>মোবাইল</th>
                    <th>ভূমিকা</th>
                    <th>তৈরি</th>
                    <th>অবস্থা</th>
                </tr>
            </thead>
            <tbody id="userBody"></tbody>
        </table>
    </div>
</div>

<!-- 🧩 Edit User Modal -->
<div class="modal fade modal-gradient" id="editUserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa-solid fa-pen-to-square me-2"></i> ইউজার সম্পাদনা</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form id="editUserForm" class="row g-3">
          <input type="hidden" id="edit_id">
          <div class="col-md-6">
            <label for="edit_name" class="form-label">নাম</label>
            <input type="text" class="form-control" id="edit_name" required>
          </div>
          <div class="col-md-6">
            <label for="edit_email" class="form-label">ইমেইল</label>
            <input type="email" class="form-control" id="edit_email" required>
          </div>
          <div class="col-md-6">
            <label for="edit_mobile" class="form-label">মোবাইল</label>
            <input type="text" class="form-control" id="edit_mobile" required>
          </div>
          <div class="col-md-6 position-relative">
            <label for="edit_role" class="form-label">ভূমিকা</label>
            <select id="edit_role" class="form-select select2" required>
              <option value="Admin">Admin</option>
              <option value="User">User</option>
              <option value="Editor">Editor</option>
              <option value="Manager">Manager</option>
            </select>
          </div>
          <div class="col-12 d-flex align-items-center mt-2">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="edit_status">
              <label class="form-check-label ms-2" for="edit_status">Active</label>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer bg-light">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">বাতিল</button>
        <button type="button" id="saveEditBtn" class="btn btn-gradient">
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
// ======= Demo dataset (আপনার ব্যাকএন্ড ডেটার বদলে ডেমো) =======
const users = [
  { id: 1, name: "Alice",   email: "alice@example.com",   mobile: "01710000001", role: "Admin",  created: "2025-09-20", status: "Active" },
  { id: 2, name: "Bob",     email: "bob@example.com",     mobile: "01710000002", role: "User",   created: "2025-09-21", status: "Inactive" },
  { id: 3, name: "Charlie", email: "charlie@example.com", mobile: "01710000003", role: "Editor", created: "2025-09-22", status: "Active" }
];

let dt; // DataTable instance
let editModal; // Bootstrap Modal instance

// ======= Utility: render status badge =======
function statusBadge(status){
  return status === "Active"
   ? `<span class="badge bg-success px-3 py-2 rounded-pill">Active</span>`
   : `<span class="badge bg-danger px-3 py-2 rounded-pill">Inactive</span>`;
}

// ======= Build initial rows then init DataTable =======
$(document).ready(function() {
  const tbody = $("#userBody");
  users.forEach(u => {
    tbody.append(`
      <tr data-id="${u.id}">
        <td>${u.id}</td>
        <td>
          <button class="btn btn-sm btn-outline-primary action-btn me-2 edit-btn" data-id="${u.id}">
            <i class="fa-solid fa-pen-to-square"></i>
          </button>
          <button class="btn btn-sm btn-outline-danger action-btn delete-btn" data-id="${u.id}">
            <i class="fa-solid fa-trash"></i>
          </button>
        </td>
        <td class="c-name"><strong>${u.name}</strong></td>
        <td class="c-email">${u.email}</td>
        <td class="c-mobile">${u.mobile}</td>
        <td class="c-role"><span class="badge bg-info text-dark px-3 py-2">${u.role}</span></td>
        <td class="c-created">${u.created}</td>
        <td class="c-status">${statusBadge(u.status)}</td>
      </tr>
    `);
  });

  dt = $('#userTable').DataTable({
    language: {
      search: "🔍 অনুসন্ধান:",
      lengthMenu: "_MENU_ জন প্রদর্শন",
      zeroRecords: "কোনো তথ্য পাওয়া যায়নি",
      info: "মোট _TOTAL_ জন ব্যবহারকারীর মধ্যে _START_ থেকে _END_ পর্যন্ত",
      infoEmpty: "কোনো তথ্য নেই",
      paginate: { previous: "⬅️", next: "➡️" }
    }
  });

  // Bootstrap modal instance
  editModal = new bootstrap.Modal(document.getElementById('editUserModal'));

  // Select2 inside modal
  $('#edit_role').select2({
    width: '100%',
    dropdownParent: $('#editUserModal')
  });

  // === Button handlers (event delegation for dynamically drawn rows) ===
  $('#userTable').on('click', '.edit-btn', function(){
    const id = Number($(this).data('id'));
    handleEditClick(id);
  });

  $('#userTable').on('click', '.delete-btn', function(){
    const id = Number($(this).data('id'));
    handleDeleteClick(id);
  });

  // Save in modal
  $('#saveEditBtn').on('click', saveEditedUser);
});

// ======= Edit flow =======
function handleEditClick(id){
  const user = users.find(u => u.id === id);
  if(!user){ return; }

  // Prefill modal inputs
  $('#edit_id').val(user.id);
  $('#edit_name').val(user.name);
  $('#edit_email').val(user.email);
  $('#edit_mobile').val(user.mobile);
  $('#edit_role').val(user.role).trigger('change');
  $('#edit_status').prop('checked', user.status === 'Active');

  // SweetAlert on button click (as per requirement)
  Swal.fire({
    title: 'এডিট মোড',
    text: `ID ${id} এর ইউজার এডিট করবেন`,
    icon: 'info',
    timer: 1200,
    showConfirmButton: false
  });

  editModal.show();
}

function saveEditedUser(){
  const id = Number($('#edit_id').val());
  const name = $('#edit_name').val().trim();
  const email = $('#edit_email').val().trim();
  const mobile = $('#edit_mobile').val().trim();
  const role = $('#edit_role').val();
  const status = $('#edit_status').is(':checked') ? 'Active' : 'Inactive';

  if(!name || !email || !mobile || !role){
    Swal.fire('দুঃখিত', 'সব ফিল্ড পূরণ করুন', 'warning');
    return;
  }

  // Update dataset
  const idx = users.findIndex(u => u.id === id);
  if(idx > -1){
    users[idx] = { ...users[idx], name, email, mobile, role, status };
  }

  // Update table row (search using data-id)
  const row = $(`#userTable tbody tr[data-id="${id}"]`);
  row.find('.c-name').html(`<strong>${name}</strong>`);
  row.find('.c-email').text(email);
  row.find('.c-mobile').text(mobile);
  row.find('.c-role').html(`<span class="badge bg-info text-dark px-3 py-2">${role}</span>`);
  row.find('.c-status').html(statusBadge(status));

  // If DataTable uses ordering/search, redraw to reflect changes neatly
  dt.row(row).invalidate().draw(false);

  editModal.hide();

  // SweetAlert success
  Swal.fire({
    title: 'আপডেট সফল',
    text: 'ইউজারের তথ্য আপডেট হয়েছে',
    icon: 'success',
    timer: 1400,
    showConfirmButton: false
  });
}

// ======= Delete flow =======
function handleDeleteClick(id){
  Swal.fire({
    title: 'আপনি কি নিশ্চিত?',
    text: "এই ইউজারকে মুছে ফেলতে চান?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'হ্যাঁ, মুছে ফেলুন!',
    cancelButtonText: 'না'
  }).then((result) => {
    if (result.isConfirmed) {
      // Remove from dataset
      const index = users.findIndex(u => u.id === id);
      if(index > -1){ users.splice(index, 1); }

      // Remove row from DataTable
      const $row = $(`#userTable tbody tr[data-id="${id}"]`);
      dt.row($row).remove().draw(false);

      Swal.fire('মুছে ফেলা হয়েছে!', 'ইউজার সফলভাবে মুছে ফেলা হয়েছে।', 'success');
    } else {
      // Optional notify on cancel (every button click shows a SweetAlert notification)
      Swal.fire({
        title: 'বাতিল করা হয়েছে',
        icon: 'info',
        timer: 900,
        showConfirmButton: false
      });
    }
  });
}
</script>
