<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>



<div class="container mt-5">
  <h3>মহাজন থেকে টাকা লোণ</h3>
  <form id="loanForm">
    <div class="mb-3">
      <label for="mahojan" class="form-label">মহাজন নির্বাচন করুন</label>
      <select class="form-select" id="mahojan" required>
        <option value="">একটি মহাজন নির্বাচন করুন</option>
        <option value="mahojan1">মহাজন ১</option>
        <option value="mahojan2">মহাজন ২</option>
        <option value="mahojan3">মহাজন ৩</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="amount" class="form-label">লোনের পরিমাণ লিখুন</label>
      <input type="number" class="form-control" id="amount" placeholder="লোনের পরিমাণ লিখুন" required>
    </div>

    <div class="mb-3">
      <label for="medium" class="form-label">লোনের মাধ্যম লিখুন</label>
      <input type="text" class="form-control" id="medium" placeholder="লোনের মাধ্যম লিখুন" required>
    </div>

    <div class="mb-3">
      <label for="loanDate" class="form-label">লোনের তারিখ </label>
      <input type="date" class="form-control" id="loanDate" required>
    </div>
    <div class="mb-3">
      <label for="time" class="form-label">সময়</label>
      <input type="time" class="form-control" id="time" required>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
</div>

<script>
  $(document).ready(function() {
    $('#loanForm').on('submit', function(event) {
      event.preventDefault();
      alert('ফর্মটি সফলভাবে জমা হয়েছে!');
    });
  });
</script>



<?php
    include 'partial/footer.php';
?>