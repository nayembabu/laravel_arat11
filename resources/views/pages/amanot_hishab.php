<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>

<style>
/* Gradient Background for whole page */
body {
    background: linear-gradient(135deg, #74ebd5, #ACB6E5);
    min-height: 100vh;
    font-family: 'Segoe UI', sans-serif;
}

/* Dropdown + Button container */
.container .d-flex {
    background: rgba(255, 255, 255, 0.3);
    padding: 12px 18px;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Gradient Button */
.btn-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
    border-radius: 30px;
    padding: 8px 20px;
    transition: 0.3s;
}
.btn-primary:hover {
    background: linear-gradient(135deg, #764ba2, #667eea);
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0,0,0,0.2);
}

/* Card */
#personCard {
    background: linear-gradient(135deg, #ffffff, #f8f9fa);
    border: none;
    border-radius: 25px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    transition: 0.4s ease-in-out;
}
#personCard:hover {
    transform: translateY(-4px);
}

/* Profile Pic */
#profilePic {
    border: 4px solid #764ba2;
    box-shadow: 0 4px 15px rgba(118,75,162,0.4);
}

/* List Items */
.list-group-item {
    border: none;
    background: transparent;
    font-weight: 500;
}

/* Deposit Button */
.btn-success {
    background: linear-gradient(135deg, #43e97b, #38f9d7);
    border: none;
    border-radius: 25px;
    padding: 10px;
    transition: 0.3s;
}
.btn-success:hover {
    background: linear-gradient(135deg, #38f9d7, #43e97b);
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0,0,0,0.2);
}

/* Modal */
.modal-content {
    border-radius: 20px;
    border: none;
    background: linear-gradient(135deg, #ffffff, #f1f4f9);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}
.modal-header {
    border-bottom: none;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: #fff;
    border-radius: 20px 20px 0 0;
}
.modal-footer {
    border-top: none;
}
</style>

<!-- Dropdown and Add New Button -->
<div class="container mt-4">
    <div class="d-flex align-items-center mb-3">
        <select class="form-select w-auto me-3" id="personSelect">
            <option value="">Select Person</option>
        </select>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPersonModal">➕ Add New</button>
    </div>

    <!-- Card for Person Details -->
    <div id="personCard" class="card mx-auto" style="display:none; max-width: 450px;">
        <div class="card-body text-center p-4">
            <img id="profilePic" src="https://via.placeholder.com/100" class="rounded-circle mb-3" width="110" height="110" alt="Profile Picture">
            <h5 id="personName" class="card-title fw-bold"></h5>
            <p id="personAddress" class="card-text mb-1"></p>
            <p id="personPhone" class="card-text mb-1"></p>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item">💰 Total Deposited: <span id="totalDeposited">0</span></li>
                <li class="list-group-item">✅ Paid: <span id="paidAmount">0</span></li>
                <li class="list-group-item">📊 Account Balance: <span id="accountBalance">0</span></li>
            </ul>
            <div class="mt-4 text-start">
                <h6 class="fw-bold">💵 Receive Deposit</h6>
                <form id="depositForm">
                    <div class="mb-2">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" id="depositDate" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Time</label>
                        <input type="time" class="form-control" id="depositTime" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Source</label>
                        <input type="text" class="form-control" id="depositSource" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" class="form-control" id="depositAmount" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Add to Cash</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Person Modal -->
<div class="modal fade" id="addPersonModal" tabindex="-1" aria-labelledby="addPersonModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="addPersonForm" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="addPersonModalLabel">➕ Add Person's Information</h5>
        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
          <div class="mb-3">
              <label class="form-label">ব‍্যক্তির নাম</label>
              <input type="text" class="form-control" id="personInputName" placeholder="ব্যক্তির নাম" required>
          </div>
          <div class="mb-3">
              <label class="form-label">মোবাইল নম্বর</label>
              <input type="text" class="form-control" id="personInputMobile" placeholder="মোবাইল নম্বর" required>
          </div>
          <div class="mb-3">
              <label class="form-label">ঠিকানা</label>
              <input type="text" class="form-control" id="personInputAddress" placeholder="ঠিকানা" required>
          </div>
          <div class="mb-3">
              <label class="form-label">হোয়াটসঅ্যাপ নম্বর</label>
              <input type="text" class="form-control" id="personInputWhatsapp" placeholder="হোয়াটসঅ্যাপ নম্বর" required>
          </div>
          <div class="mb-3">
              <label class="form-label">ইমো নম্বর</label>
              <input type="text" class="form-control" id="personInputImo" placeholder="ইমো নম্বর" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">বন্ধ করুন</button>
        <button type="submit" class="btn btn-primary rounded-pill">যোগ করুন</button>
      </div>
    </form>
  </div>
</div>

<?php
    include 'partial/footer.php';
?>
<script>
let persons = [
    {
        id: 1,
        name: "John Doe",
        mobile: "0123456789",
        address: "123 Main St",
        whatsapp: "0123456789",
        imo: "0123456789",
        profile: "https://via.placeholder.com/100",
        totalDeposited: 5000,
        paid: 2000,
        balance: 3000
    }
];

function populateDropdown() {
    const select = document.getElementById('personSelect');
    select.innerHTML = '<option value="">Select Person</option>';
    persons.forEach(person => {
        const option = document.createElement('option');
        option.value = person.id;
        option.textContent = person.name;
        select.appendChild(option);
    });
}
populateDropdown();

document.getElementById('personSelect').addEventListener('change', function() {
    const val = this.value;
    const card = document.getElementById('personCard');
    if (!val) {
        card.style.display = 'none';
        return;
    }
    const person = persons.find(p => p.id == val);
    if (person) {
        document.getElementById('profilePic').src = person.profile;
        document.getElementById('personName').textContent = person.name;
        document.getElementById('personAddress').textContent = "Address: " + person.address;
        document.getElementById('personPhone').textContent = "Phone: " + person.mobile;
        document.getElementById('totalDeposited').textContent = person.totalDeposited;
        document.getElementById('paidAmount').textContent = person.paid;
        document.getElementById('accountBalance').textContent = person.balance;
        card.style.display = 'block';
    }
});

document.getElementById('addPersonForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const name = document.getElementById('personInputName').value.trim();
    const mobile = document.getElementById('personInputMobile').value.trim();
    const address = document.getElementById('personInputAddress').value.trim();
    const whatsapp = document.getElementById('personInputWhatsapp').value.trim();
    const imo = document.getElementById('personInputImo').value.trim();

    if (!name || !mobile || !address || !whatsapp || !imo) {
        alert('Please fill all fields.');
        return;
    }

    const newPerson = {
        id: persons.length ? persons[persons.length-1].id + 1 : 1,
        name,
        mobile,
        address,
        whatsapp,
        imo,
        profile: "https://via.placeholder.com/100",
        totalDeposited: 0,
        paid: 0,
        balance: 0
    };
    persons.push(newPerson);
    populateDropdown();
    document.getElementById('addPersonForm').reset();
    var modal = bootstrap.Modal.getInstance(document.getElementById('addPersonModal'));
    modal.hide();
});

document.getElementById('depositForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const date = document.getElementById('depositDate').value;
    const time = document.getElementById('depositTime').value;
    const source = document.getElementById('depositSource').value.trim();
    const amount = document.getElementById('depositAmount').value.trim();

    if (!date || !time || !source || !amount) {
        alert('Please fill all fields.');
        return;
    }

    alert('Deposit added!');
    document.getElementById('depositForm').reset();
});
</script>
