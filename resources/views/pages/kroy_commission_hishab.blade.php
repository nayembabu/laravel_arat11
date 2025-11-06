@include('partials.header')
@include('partials.topmenu')
@include('partials.sidebar')



<div class="container-fluid mt-4">
    <!-- Page Heading and Breadcrumb -->
    <div class="row mb-3">
        <div class="col">
            <h3 class="mb-0">Buy Commission Report</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white px-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sales Commission Report</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Filter Form -->
    <form id="commissionFilterForm" class="card mb-4 p-3">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="fromDate" class="form-label">From Date</label>
                <input type="text" class="form-control datepicker" id="fromDate" name="from_date" value="08-09-2025" autocomplete="off">
            </div>
            <div class="col-md-3">
                <label for="toDate" class="form-label">To Date</label>
                <input type="text" class="form-control datepicker" id="toDate" name="to_date" value="08-09-2025" autocomplete="off">
            </div>
            <div class="col-md-4">
                <label for="customer" class="form-label">Customer</label>
                <select class="form-select select2" id="customer" name="customer_id" style="width: 100%;" data-placeholder="Select Customer">
                    <option>Customer 1</option>
                    <option>Customer 2</option>
                    <option>Customer 3</option>
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
        </div>
    </form>

    <!-- Current Balance Section -->
    <div class="card mb-4">
        <div class="card-header bg-light">
            <strong>Customer Information</strong>
        </div>
        <div class="card-body row" id="customerInfo">
            <div class="col-md-3 mb-2">
                <label class="form-label ">Customer Due</label>
                <div id="currentBalance">-</div>
            </div>
            <div class="col-md-3 mb-2">
                <label class="form-label">Customer Name</label>
                <div id="customerName">-</div>
            </div>
            <div class="col-md-3 mb-2">
                <label class="form-label">Customer Mobile</label>
                <div id="customerMobile">-</div>
            </div>
            <div class="col-md-3 mb-2">
                <label class="form-label">Customer Address</label>
                <div id="customerAddress">-</div>
            </div>
    </div>

    <!-- Report Table -->
    <div class="card">
        <div class="card-header bg-light">
            <strong>Commission Calculation Table</strong>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0" id="commissionTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Option</th>
                            <th>Entry Date</th>
                            <th>Buy Date</th>
                            <th>Details</th>
                            <th>Previous Balance</th>
                            <th>Amount / Price</th>
                            <th>Current Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dynamic rows -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
$(function() {
    // Initialize datepickers
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true
    });

    // Initialize Select2
    $('.select2').select2({
        placeholder: 'Select Customer',
        allowClear: true,
        width: 'resolve'
    });

    // Fetch customers for dropdown (AJAX)
    function loadCustomers() {
        $.ajax({
            url: 'api/get_customers.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var $customer = $('#customer');
                $customer.empty().append('<option></option>');
                $.each(data, function(i, customer) {
                    $customer.append(
                        $('<option>', { value: customer.id, text: customer.name })
                    );
                });
            }
        });
    }
    loadCustomers();

    // Handle form submit
    $('#commissionFilterForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: 'api/get_commission_report.php',
            method: 'GET',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                $('#commissionTable tbody').html('<tr><td colspan="8" class="text-center">Loading...</td></tr>');
            },
            success: function(response) {
                // Update customer info
                $('#customerName').text(response.customer.name || '-');
                $('#customerMobile').text(response.customer.mobile || '-');
                $('#customerAddress').text(response.customer.address || '-');

                // Populate table
                var rows = '';
                if (response.data && response.data.length) {
                    $.each(response.data, function(i, row) {
                        rows += '<tr>' +
                            '<td>' + (i + 1) + '</td>' +
                            '<td><button class="btn btn-sm btn-primary view-btn" data-id="' + row.id + '"><i class="bi bi-eye"></i></button></td>' +
                            '<td>' + row.entry_date + '</td>' +
                            '<td>' + row.sale_date + '</td>' +
                            '<td>' + row.details + '</td>' +
                            '<td>' + row.previous_balance + '</td>' +
                            '<td>' + row.amount + '</td>' +
                            '<td>' + row.current_balance + '</td>' +
                        '</tr>';
                    });
                } else {
                    rows = '<tr><td colspan="8" class="text-center">No data found.</td></tr>';
                }
                $('#commissionTable tbody').html(rows);
            },
            error: function() {
                $('#commissionTable tbody').html('<tr><td colspan="8" class="text-center text-danger">Error loading data.</td></tr>');
            }
        });
    });

    // Optionally, trigger initial search
    // $('#commissionFilterForm').submit();
});
</script>


@include('partials.footer')