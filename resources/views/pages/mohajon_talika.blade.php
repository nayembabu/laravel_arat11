<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>

<div class="container mt-4">
     <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="notun_mohajon.php" class="btn btn-primary mb-3">নতুন মহাজন যোগ করুন</a>
        <form class="d-flex" method="get" action="">
            <input class="form-control me-2" type="search" name="search" placeholder="মহাজনের নাম দিয়ে খুঁজুন" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">খুঁজুন</button>
        </form>
     </div>

    <table class="table table-bordered" id="mohajonTable">
        <thead>
            <tr>
                <th>SL</th>
                <th>মহাজনের আইডি</th>
                <th>আমদানীকারকের নাম</th>
                <th>মোবাইল</th>
                <th>বকেয়া</th>
                <th>অপশন</th>
            </tr>
        </thead>
        <tbody>
            <!-- ডাইনামিকালি জাভাস্ক্রিপ্ট থেকে আসবে -->
        </tbody>
    </table>
</div>

<!-- 🔹 Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">মহাজন এডিট করুন</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editForm">
          <input type="hidden" id="editIndex">
          <div class="mb-3">
            <label class="form-label">আমদানীকারকের নাম</label>
            <input type="text" id="editName" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">মোবাইল</label>
            <input type="text" id="editMobile" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">বকেয়া</label>
            <input type="number" id="editDue" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-success">আপডেট করুন</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- 🔹 Delete Modal (with Select2) -->
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">মহাজন ডিলিট করুন</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="deleteForm">
          <div class="mb-3">
            <label class="form-label">ডিলিট করতে মহাজন সিলেক্ট করুন</label>
            <select id="deleteSelect" class="form-select" style="width:100%"></select>
          </div>
          <button type="submit" class="btn btn-danger">ডিলিট করুন</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
    include 'partial/footer.php';
?>

<script>
let mohajons = [
    {id: 1, name: "রহিম উদ্দিন", mobile: "017XXXXXXXX", due: 5000},
    {id: 2, name: "করিম মিয়া", mobile: "018XXXXXXXX", due: 3000}
];

const tableBody = document.querySelector("#mohajonTable tbody");

// টেবিল রেন্ডার ফাংশন
function renderTable() {
    tableBody.innerHTML = "";
    mohajons.forEach((m, index) => {
        tableBody.innerHTML += `
            <tr>
                <td>${index+1}</td>
                <td>${m.id}</td>
                <td>${m.name}</td>
                <td>${m.mobile}</td>
                <td>${m.due}</td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="openEditModal(${index})">এডিট</button>
                    <button class="btn btn-sm btn-danger" onclick="openDeleteModal(${index})">ডিলিট</button>
                </td>
            </tr>
        `;
    });
}

// এডিট Modal খোলা
function openEditModal(index) {
    document.getElementById("editIndex").value = index;
    document.getElementById("editName").value = mohajons[index].name;
    document.getElementById("editMobile").value = mohajons[index].mobile;
    document.getElementById("editDue").value = mohajons[index].due;

    let modal = new bootstrap.Modal(document.getElementById("editModal"));
    modal.show();
}

// এডিট সাবমিট
document.getElementById("editForm").addEventListener("submit", function(e){
    e.preventDefault();
    let index = document.getElementById("editIndex").value;
    mohajons[index].name = document.getElementById("editName").value;
    mohajons[index].mobile = document.getElementById("editMobile").value;
    mohajons[index].due = document.getElementById("editDue").value;

    renderTable();

    let modalEl = document.getElementById("editModal");
    bootstrap.Modal.getInstance(modalEl).hide();
});

// 🔹 Delete Modal খোলা (Select2 অপশন লোড)
function openDeleteModal(index) {
    let select = document.getElementById("deleteSelect");
    select.innerHTML = "";
    mohajons.forEach((m, i) => {
        let opt = document.createElement("option");
        opt.value = i;
        opt.textContent = m.name + " ("+m.mobile+")";
        select.appendChild(opt);
    });

    // Select2 ইনিশিয়ালাইজ (CDN তুমি নিজেই দিবে)
    $('#deleteSelect').select2({
        dropdownParent: $('#deleteModal')
    });

    let modal = new bootstrap.Modal(document.getElementById("deleteModal"));
    modal.show();
}

// Delete সাবমিট
document.getElementById("deleteForm").addEventListener("submit", function(e){
    e.preventDefault();
    let index = document.getElementById("deleteSelect").value;
    if(index !== null){
        mohajons.splice(index, 1);
        renderTable();
    }

    let modalEl = document.getElementById("deleteModal");
    bootstrap.Modal.getInstance(modalEl).hide();
});

// প্রথমবার টেবিল লোড
renderTable();
</script>
    