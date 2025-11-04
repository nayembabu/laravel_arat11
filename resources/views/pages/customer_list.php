<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>

<div class="container mt-4">
    <h3 class="text-center">কাস্টমার তালিকা</h3>
    <table id="customerTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>SL No</th>
                <th>কাস্টমার নাম</th>
                <th>মোবাইল</th>
                <th>ঠিকানা</th>
                <th>বাকী টাকা</th>
                <th>অপশন</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>0123456789</td>
                <td>123 Main St</td>
                <td>0</td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn"> তথ্য এডিট</button>
                    <button class="btn btn-sm btn-danger dueEditBtn"> বকেয়া এডিট</button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jane Smith</td>
                <td>0987654321</td>
                <td>456 Elm St</td>
                <td>150</td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn"> তথ্য এডিট</button>
                    <button class="btn btn-sm btn-danger dueEditBtn"> বকেয়া এডিট</button>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Michael Johnson</td>
                <td>0112233445</td>
                <td>789 Oak St</td>
                <td>75</td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn"> তথ্য এডিট</button>
                    <button class="btn btn-sm btn-danger dueEditBtn"> বকেয়া এডিট</button>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>Emily Davis</td>
                <td>0223344556</td>
                <td>321 Pine St</td>
                <td>200</td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn"> তথ্য এডিট</button>
                    <button class="btn btn-sm btn-danger dueEditBtn"> বকেয়া এডিট</button>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>David Wilson</td>
                <td>0334455667</td>
                <td>654 Cedar St</td>
                <td>0</td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn"> তথ্য এডিট</button>
                    <button class="btn btn-sm btn-danger dueEditBtn"> বকেয়া এডিট</button>
                </td>
            </tr>
            <tr>
                <td>6</td>
                <td>Sarah Brown</td>
                <td>0445566778</td>
                <td>987 Birch St</td>
                <td>50</td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn"> তথ্য এডিট</button>
                    <button class="btn btn-sm btn-danger dueEditBtn"> বকেয়া এডিট</button>
                </td>
            </tr>
            <tr>
                <td>7</td>
                <td>Chris Taylor</td>
                <td>0556677889</td>
                <td>159 Maple St</td>
                <td>300</td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn"> তথ্য এডিট</button>
                    <button class="btn btn-sm btn-danger dueEditBtn"> বকেয়া এডিট</button>
                </td>
            </tr>
            <tr>
                <td>8</td>
                <td>Amy Martinez</td>
                <td>0667788990</td>
                <td>753 Walnut St</td>
                <td>0</td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn"> তথ্য এডিট</button>
                    <button class="btn btn-sm btn-danger dueEditBtn"> বকেয়া এডিট</button>
                </td>
            </tr>
            <tr>
                <td>9</td>
                <td>James Anderson</td>
                <td>0778899001</td>
                <td>852 Chestnut St</td>
                <td>120</td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn"> তথ্য এডিট</button>
                    <button class="btn btn-sm btn-danger dueEditBtn"> বকেয়া এডিট</button>
                </td>
            </tr>
            <tr>
                <td>10</td>
                <td>Linda Thomas</td>
                <td>0889900112</td>
                <td>951 Spruce St</td>
                <td>0</td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn"> তথ্য এডিট</button>
                    <button class="btn btn-sm btn-danger dueEditBtn"> বকেয়া এডিট</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- তথ্য এডিট Modal -->
<div class="modal fade" id="infoModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">তথ্য এডিট</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="infoForm">
          <input type="hidden" id="rowIndex">
          <div class="mb-3">
            <label class="form-label">কাস্টমার নাম</label>
            <input type="text" class="form-control" id="customerName">
          </div>
          <div class="mb-3">
            <label class="form-label">মোবাইল</label>
            <input type="text" class="form-control" id="customerMobile">
          </div>
          <div class="mb-3">
            <label class="form-label">ঠিকানা</label>
            <input type="text" class="form-control" id="customerAddress">
          </div>
          <button type="submit" class="btn btn-primary">সেভ করুন</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- বকেয়া এডিট Modal -->
<div class="modal fade" id="dueModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">বকেয়া এডিট</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="dueForm">
          <input type="hidden" id="dueRowIndex">
          <div class="mb-3">
            <label class="form-label">বাকী টাকা</label>
            <input type="number" class="form-control" id="customerDue">
          </div>
          <button type="submit" class="btn btn-primary">সেভ করুন</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php
    include 'partial/footer.php';
?>



<script>
$(document).ready(function() {

    // তথ্য এডিট বাটন
    $(".editBtn").click(function() {
        let row = $(this).closest("tr");
        $("#rowIndex").val(row.index());
        $("#customerName").val(row.find("td:eq(1)").text());
        $("#customerMobile").val(row.find("td:eq(2)").text());
        $("#customerAddress").val(row.find("td:eq(3)").text());
        $("#infoModal").modal("show");
    });

    $("#infoForm").submit(function(e) {
        e.preventDefault();
        let rowIndex = $("#rowIndex").val();
        let row = $("#customerTable tbody tr").eq(rowIndex);
        row.find("td:eq(1)").text($("#customerName").val());
        row.find("td:eq(2)").text($("#customerMobile").val());
        row.find("td:eq(3)").text($("#customerAddress").val());
        $("#infoModal").modal("hide");
    });

    // বকেয়া এডিট বাটন
    $(".dueEditBtn").click(function() {
        let row = $(this).closest("tr");
        $("#dueRowIndex").val(row.index());
        $("#customerDue").val(row.find("td:eq(4)").text());
        $("#dueModal").modal("show");
    });

    $("#dueForm").submit(function(e) {
        e.preventDefault();
        let rowIndex = $("#dueRowIndex").val();
        let row = $("#customerTable tbody tr").eq(rowIndex);
        row.find("td:eq(4)").text($("#customerDue").val());
        $("#dueModal").modal("hide");
    });

});
</script>

