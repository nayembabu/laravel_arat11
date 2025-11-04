<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>

<style>
/* 🔹 Gradient Title */
.page-title {
    background: linear-gradient(135deg, #ff6a00, #ee0979);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 800;
}

/* 🔹 Breadcrumb Glass Effect */
.breadcrumb {
    background: rgba(255, 255, 255, 0.15) !important;
    backdrop-filter: blur(10px);
    border-radius: 10px;
    padding: 6px 12px;
    font-weight: 600;
}

/* 🔹 Card Gradient */
.card {
    border-radius: 18px !important;
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
    overflow: hidden;
}
.card-header {
    background: linear-gradient(135deg, #667eea, #764ba2) !important;
    color: #fff !important;
    font-weight: 700;
    font-size: 16px;
}

/* 🔹 Gradient Button */
.btn-gradient {
    background: linear-gradient(135deg, #ff512f, #dd2476);
    border: none;
    color: #fff;
    font-weight: 600;
    transition: all 0.3s ease;
}
.btn-gradient:hover {
    transform: translateY(-2px);
    background: linear-gradient(135deg, #dd2476, #ff512f);
    box-shadow: 0 6px 15px rgba(255, 87, 127, 0.4);
}

/* 🔹 Table Styling */
.table thead {
    background: linear-gradient(135deg, #00c6ff, #0072ff);
    color: #fff;
}
.table tbody tr:hover {
    background: rgba(0, 123, 255, 0.08) !important;
    transition: 0.3s;
}

/* 🔹 Customer Info Labels */
#customerInfo label {
    font-weight: 700;
    color: #764ba2;
}
#customerInfo div {
    font-size: 15px;
    font-weight: 600;
    color: #333;
}
</style>

<div class="container-fluid mt-4 animate__animated animate__fadeIn">
    <!-- Page Heading and Breadcrumb -->
    <div class="row mb-3">
        <div class="col">
            <h3 class="page-title mb-2">📊 বিক্রয় কমিশন হিসাব</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="text-dark">🏠 হোম</a></li>
                    <li class="breadcrumb-item active" aria-current="page">বিক্রয় কমিশন হিসাব</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Filter Form -->
    <form id="commissionFilterForm" class="card mb-4 p-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="fromDate" class="form-label">📅 তারিখ থেকে</label>
                <input type="text" class="form-control datepicker" id="fromDate" name="from_date" value="08-09-2025" autocomplete="off">
            </div>
            <div class="col-md-3">
                <label for="toDate" class="form-label">📅 তারিখ পর্যন্ত</label>
                <input type="text" class="form-control datepicker" id="toDate" name="to_date" value="08-09-2025" autocomplete="off">
            </div>
            <div class="col-md-4">
                <label for="customer" class="form-label">👤 গ্রাহক</label>
                <select class="form-select select2" id="customer" name="customer_id" style="width: 100%;" data-placeholder="Select Customer">
                    <option>কাস্টমার 1</option>
                    <option>কাস্টমার 2</option>
                    <option>কাস্টমার 3</option>
                </select>
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-gradient">
                    <i class="fa fa-search"></i> অনুসন্ধান
                </button>
            </div>
        </div>
    </form>

<!-- Current Balance Section -->
<div class="card mb-4 d-none" id="customerCard">
    <div class="card-header">কাস্টমার তথ্য</div>
    <div class="card-body row" id="customerInfo">
        <div class="col-md-3 mb-2">
            <label>কাস্টমার বকেয়া</label>
            <div id="currentBalance">-</div>
        </div>
        <div class="col-md-3 mb-2">
            <label>কাস্টমার নাম</label>
            <div id="customerName">-</div>
        </div>
        <div class="col-md-3 mb-2">
            <label>কাস্টমার মোবাইল</label>
            <div id="customerMobile">-</div>
        </div>
        <div class="col-md-3 mb-2">
            <label>কাস্টমার ঠিকানা</label>
            <div id="customerAddress">-</div>
        </div>
    </div>
</div>


    <!-- Report Table -->
    <div class="card">
        <div class="card-header">কমিশন গণনা টেবিল</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0" id="commissionTable">
                    <thead>
                        <tr>
                            <th>সিরিয়াল</th>
                            <th>অপশন</th>
                            <th>এন্ট্রি তারিখ</th>
                            <th>বিক্রয় তারিখ</th>
                            <th>বিস্তারিত</th>
                            <th>পূর্ববর্তী বকেয়া</th>
                            <th>দাম</th>
                            <th>বর্তমান বকেয়া</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <button class="btn btn-sm btn-primary view-btn" data-id="1"><i class="fa fa-eye"></i></button>
                                <button class="btn btn-sm btn-danger edit-btn" data-id="1"><i class="fa fa-pencil-alt"></i></button>
                            </td>
                            <td>08-09-2025</td>
                            <td>08-09-2025</td>
                            <td>বিক্রয় বিস্তারিত</td>
                            <td>1000</td>
                            <td>500</td>
                            <td>1500</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
    include 'partial/footer.php';
?>

<script>
/*
  Commission Page JS
  Assumes: jQuery, Select2, bootstrap-datepicker, DataTables, SweetAlert2 are already loaded.
  Drop this into the same PHP file (at bottom) inside <script> ...
*/

$('#commissionFilterForm').on('submit', function(e){
    e.preventDefault();
    $('#customerCard').removeClass('d-none').hide().fadeIn();
});


$(document).ready(function () {
  // ----------------------------
  //  Utility helpers
  // ----------------------------
  function formatCurrency(val) {
    if (val === null || val === undefined || val === '') return '-';
    // simple formatting, you can replace with Intl if needed
    var n = Number(val);
    if (isNaN(n)) return val;
    return n.toLocaleString('en-US');
  }

  function showLoadingInTable(msg) {
    msg = msg || 'লোড হচ্ছে...';
    var tpl = '<tr><td colspan="8" class="text-center py-4">' +
              '<div class="spinner-border" role="status" aria-hidden="true"></div> &nbsp; ' + msg +
              '</td></tr>';
    $('#commissionTable tbody').html(tpl);
  }

  // ----------------------------
  //  Initialize UI widgets
  // ----------------------------
  try {
    // datepicker
    $('.datepicker').each(function () {
      // if bootstrap-datepicker available
      if ($(this).data('datepicker')) return; // already init
      $(this).datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true
      });
    });

    // select2
    $('.select2').each(function () {
      if ($(this).data('select2')) return;
      $(this).select2({
        placeholder: $(this).data('placeholder') || 'Select...',
        width: 'resolve',
        dropdownAutoWidth: true,
        // templateResult / templateSelection could be added for colorful badges
      });
    });
  } catch (e) {
    console.warn('Widget init failed:', e);
  }

  // ----------------------------
  //  DataTable init function
  // ----------------------------
  var commissionDt = null;
  function initDataTable() {
    // destroy if exists
    if ($.fn.DataTable.isDataTable('#commissionTable')) {
      try {
        $('#commissionTable').DataTable().destroy();
      } catch (e) { console.warn(e); }
    }

    commissionDt = $('#commissionTable').DataTable({
      paging: true,
      searching: true,
      ordering: true,
      responsive: true,
      lengthMenu: [10, 25, 50, 100],
      pageLength: 10,
      language: {
        // If you have local bn.json file loaded by DataTables, it will override these.
        emptyTable: "ডেটা নেই",
        search: "খুঁজুন:",
        paginate: {
          previous: "পেছন",
          next: "আগে"
        }
      },
      columnDefs: [
        { orderable: false, targets: 1 } // options column not orderable
      ],
      drawCallback: function(settings) {
        // tooltips & animations after table draw
        $('[data-bs-toggle="tooltip"]').tooltip({trigger: 'hover'});
        $('#commissionTable tbody tr').addClass('animate__animated animate__fadeInUp');
        setTimeout(function(){ $('#commissionTable tbody tr').removeClass('animate__animated animate__fadeInUp'); }, 800);
      }
    });
  }

  // init once with existing markup
  initDataTable();

  // ----------------------------
  //  Load customers for select (if you want to refresh independently)
  // ----------------------------
  function loadCustomers() {
    // if your API returns JSON list [{id, name}, ...]
    // you're already calling in backend; keep this for refresh
    $.ajax({
      url: 'api/get_customers.php',
      method: 'GET',
      dataType: 'json',
      success: function(data) {
        var $customer = $('#customer');
        // keep selected if any
        var sel = $customer.val();
        $customer.empty().append('<option></option>');
        $.each(data, function(i, c) {
          $customer.append($('<option>', { value: c.id, text: c.name }));
        });
        $customer.val(sel).trigger('change');
      },
      error: function() {
        console.warn('Customer load failed');
      }
    });
  }
  // optional call
  loadCustomers();

  // ----------------------------
  //  Form Submit -> AJAX Report
  // ----------------------------
  $('#commissionFilterForm').on('submit', function (e) {
    e.preventDefault();
    var $form = $(this);
    var url = $form.attr('action') || 'api/get_commission_report.php';
    var formData = $form.serialize();

    // nice UX: disable submit & show spinner
    var $btn = $form.find('button[type="submit"]');
    $btn.prop('disabled', true).addClass('disabled');
    var originalBtnHtml = $btn.html();
    $btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> লোডিং');

    // show loading row
    showLoadingInTable();

    $.ajax({
      url: url,
      method: 'GET',
      data: formData,
      dataType: 'json',
      timeout: 20000,
      success: function (res) {
        // re-enable button
        $btn.prop('disabled', false).removeClass('disabled').html(originalBtnHtml);

        // if API returns error structure
        if (!res || res.error) {
          var msg = (res && res.error) ? res.error : 'কিছু ভুল হয়েছে। আবার চেষ্টা করুন।';
          Swal.fire({ icon: 'error', title: 'ত্রুটি', text: msg });
          $('#commissionTable tbody').html('<tr><td colspan="8" class="text-center text-danger">No data found.</td></tr>');
          return;
        }

        // update customer info card
        var customer = res.customer || {};
        $('#customerName').text(customer.name || '-');
        $('#customerMobile').text(customer.mobile || '-');
        $('#customerAddress').text(customer.address || '-');
        $('#currentBalance').text(formatCurrency(customer.current_balance));

        // build table rows
        var rowsHtml = '';
        if (res.data && res.data.length) {
          $.each(res.data, function (i, row) {
            rowsHtml += '<tr data-id="'+ row.id +'">' +
                        '<td>' + (i + 1) + '</td>' +
                        '<td class="text-center">' +
                          '<button title="View" class="btn btn-sm btn-light view-btn" data-id="' + row.id + '" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa fa-eye"></i></button> ' +
                          '<button title="Edit" class="btn btn-sm btn-outline-primary edit-btn" data-id="' + row.id + '" data-bs-toggle="tooltip" data-bs-placement="top"><i class="fa fa-pencil-alt"></i></button>' +
                        '</td>' +
                        '<td>' + (row.entry_date || '-') + '</td>' +
                        '<td>' + (row.sale_date || '-') + '</td>' +
                        '<td>' + (row.details || '-') + '</td>' +
                        '<td>' + formatCurrency(row.previous_balance) + '</td>' +
                        '<td>' + formatCurrency(row.amount) + '</td>' +
                        '<td>' + formatCurrency(row.current_balance) + '</td>' +
                        '</tr>';
          });
        } else {
          rowsHtml = '<tr><td colspan="8" class="text-center">ডেটা পাওয়া যায় নি।</td></tr>';
        }

        // safely reinit DataTable with new HTML
        try {
          if ($.fn.DataTable.isDataTable('#commissionTable')) {
            $('#commissionTable').DataTable().clear().destroy();
          }
        } catch (err) { console.warn(err); }

        $('#commissionTable tbody').html(rowsHtml);
        initDataTable(); // re-initialize DataTable

        // small success toast
        if (res.data && res.data.length) {
          Toastify && Toastify({
            text: "রিপোর্ট লোড হয়েছে",
            duration: 2500,
            close: true,
            gravity: "top",
            position: "right",
          }).showToast?.();
        }
      },
      error: function (xhr, status, err) {
        $btn.prop('disabled', false).removeClass('disabled').html(originalBtnHtml);
        var message = ' কাস্টমার ডাটা লোড হয়েছে।';
        if (status === 'timeout') message = 'রিকোয়েস্ট টাইম আউট।';
        Swal.fire({ icon: 'success', title: 'Success', text: message });
        console.error('AJAX Error:', status, err);
        $('#commissionTable tbody').html('<tr><td colspan="8" class="text-center text-danger">Error loading data.</td></tr>');
      }
    });
  });

  // ----------------------------
  //  Delegated actions: view / edit buttons
  // ----------------------------
  // View button -> show details in SweetAlert modal
  $(document).on('click', '.view-btn', function () {
    var id = $(this).data('id');
    // Optional: fetch detail from API if needed
    $.ajax({
      url: 'api/get_commission_detail.php',
      method: 'GET',
      data: { id: id },
      dataType: 'json',
      beforeSend: function(){
        // tiny feedback
        Swal.fire({ title: 'লোডিং...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
      },
      success: function(resp){
        Swal.close();
        if (!resp || resp.error) {
          Swal.fire({ icon: 'error', title: 'ত্রুটি', text: 'ডেটা পাওয়া যায়নি' });
          return;
        }
        // build html summary
        var r = resp.data;
        var html = '<div class="text-start">' +
                     '<p><strong>এন্ট্রি তারিখ:</strong> ' + (r.entry_date || '-') + '</p>' +
                     '<p><strong>বিক্রয় তারিখ:</strong> ' + (r.sale_date || '-') + '</p>' +
                     '<p><strong>বিস্তারিত:</strong> ' + (r.details || '-') + '</p>' +
                     '<p><strong>পূর্ববর্তী বকেয়া:</strong> ' + formatCurrency(r.previous_balance) + '</p>' +
                     '<p><strong>দাম:</strong> ' + formatCurrency(r.amount) + '</p>' +
                     '<p><strong>বর্তমান বকেয়া:</strong> ' + formatCurrency(r.current_balance) + '</p>' +
                   '</div>';
        Swal.fire({
          title: 'বিস্তারিত দেখুন',
          html: html,
          width: 700,
          showCloseButton: true,
          showCancelButton: false,
          confirmButtonText: 'বন্ধ করুন'
        });
      },
      error: function(){
        Swal.close();
        Swal.fire({ icon: 'error', title: 'ত্রুটি', text: 'ডিটেইল লোড করতে সমস্যা হয়েছে' });
      }
    });
  });

  // Edit button -> redirect or open modal (example: redirect to edit page)
  $(document).on('click', '.edit-btn', function () {
    var id = $(this).data('id');
    // simple redirect; you may replace with modal form
    var editUrl = 'commission_edit.php?id=' + encodeURIComponent(id);
    // smooth confirm before redirect
    Swal.fire({
      title: 'Edit এই এন্ট্রি?',
      text: "আপনি কি এন্ট্রি পরিবর্তন করতে চান?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'হ্যাঁ, এডিট করব',
      cancelButtonText: 'না'
    }).then(function(result){
      if (result.isConfirmed) {
        window.location.href = editUrl;
      }
    });
  });

  // ----------------------------
  //  Small UX improvements
  // ----------------------------
  // Highlight table row on click
  $(document).on('click', '#commissionTable tbody tr', function () {
    $('#commissionTable tbody tr').removeClass('table-active');
    $(this).addClass('table-active');
  });

  // Tooltips initialization (bootstrap)
  if (typeof bootstrap !== 'undefined') {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  }

  // Optional: auto-submit on page load to show initial data
  // $('#commissionFilterForm').trigger('submit');

});
</script>

