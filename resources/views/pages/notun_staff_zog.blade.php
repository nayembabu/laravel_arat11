<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>

<div class="container mt-4">
    <h2>Add New Staff</h2>

    <form id="addStaffForm">
        <div class="row ">
            <div class="col-lg-6 mb-3">
                <label for="staffName" class="form-label">Staff Name</label>
                <input type="text" class="form-control" id="staffName" required>
            </div>
            <div class="col-lg-6 mb-3">
                <label for="staffMobile" class="form-label">Staff Mobile No</label>
                <input type="text" class="form-control" id="staffMobile" required>
            </div>
            <div class="col-lg-6 mb-3">
                <label for="staffAddress" class="form-label">Staff Address</label>
                <input type="text" class="form-control" id="staffAddress" required>
            </div>
            <div class="col-lg-6 mb-3">
                <label for="staffDOB" class="form-label">Date Of Birth</label>
                <input type="text" class="form-control datepicker" id="staffDOB" required>
            </div>
            <div class="col-lg-6 mb-3">
                <label for="staffNID" class="form-label">NID Number</label>
                <input type="text" class="form-control" id="staffNID" required>
            </div>
            <div class="col-lg-6 mb-3">
                <label for="staffSalary" class="form-label">Staff Salary</label>
                <input type="text" class="form-control" id="staffSalary" required>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-primary">Add Staff</button>
    </form>

    <h3 class="mt-5">Staff List</h3>
    <table class="table table-bordered" id="staffTable">
        <thead>
            <tr>
                <th>SL</th>
                <th>Staff Name</th>
                <th>Mobile No</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>0123456789</td>
                <td>123 Main St</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jane Smith</td>
                <td>0987654321</td>
                <td>456 Elm St</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Mike Johnson</td>
                <td>0112233445</td>
                <td>789 Oak St</td>
            </tr>
        </tbody>
    </table>
</div>

<?php
    include 'partial/footer.php';
?>