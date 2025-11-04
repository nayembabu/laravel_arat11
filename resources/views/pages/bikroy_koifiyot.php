<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>

<div class="container mt-4">
  <h2 class="mb-4">বিক্রয় কৈফিয়ত</h2>
  <form id="searchForm" class="row g-3 align-items-end">
    <div class="col-auto">
      <label for="from_date" class="form-label">From Date</label>
      <input type="text" class="form-control" id="from_date" value="DD-MM-YYYY" name="from_date" autocomplete="off" required>
    </div>
    <div class="col-auto">
      <label for="to_date" class="form-label">To Date</label>
      <input type="text" class="form-control" id="to_date" value="DD-MM-YYYY" name="to_date" autocomplete="off" required>
    </div>
    <div class="col-auto">
      <label for="customer" class="form-label">Customer</label>
      <select class="form-select" id="customer" name="customer" style="width: 200px;" required>
        <option value="">Select Customer</option>
        <option value="1">Customer A</option>
        <option value="2">Customer B</option>
        <option value="3">Customer C</option>
      </select>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary">Search</button>
    </div>
  </form>

  <div id="actionButtons" class="mt-4" style="display:none;">
    <button class="btn btn-outline-success me-2" data-info="Info 1">Show Info 1</button>
    <button class="btn btn-outline-info me-2" data-info="Info 2">Show Info 2</button>
    <button class="btn btn-outline-warning" data-info="Info 3">Show Info 3</button>
  </div>

  <div id="infoCard" class="mt-4"></div>
</div>


<script>
$(function() {
  $("#from_date, #to_date").datepicker({ dateFormat: 'dd-mm-yy' });
  $('#customer').select2();

  $('#searchForm').on('submit', function(e) {
    e.preventDefault();
    if($('#customer').val()) {
      $('#actionButtons').show();
      $('#infoCard').empty();
    } else {
      $('#actionButtons').hide();
      $('#infoCard').empty();
    }
  });

  $('#actionButtons button').on('click', function() {
    var info = $(this).data('info');
    var cardHtml = `
      <div class="card" style="max-width: 400px;">
        <div class="card-body">
          <h5 class="card-title">${info}</h5>
          <p class="card-text">কাস্টমার এর পণ্য বিবরণ: আলুr(ডায়মন্ড) (মোট ৩৩১৫কেজি) (রেট ১৭/-) </p>
          <p class="card-text">কাস্টমার এর পণ্য পরিমাণ: আলু ১০০ কেজি </p>
          <p class="card-text">কাস্টমার এর মোট টাকা : ১০০০০ টাকা </p>
          <input type="text" class="form-control mb-2" placeholder="মারফত টাকা দিন">
          <button class="btn btn-primary">Submit</button>
        </div>
      </div>
    `;
    $('#infoCard').html(cardHtml);
  });
});
</script>
<?php
    include 'partial/footer.php';
?>

