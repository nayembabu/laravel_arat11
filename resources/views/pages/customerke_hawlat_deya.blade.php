@include('partials.header')
@include('partials.topmenu')
@include('partials.sidebar')





<div class="container mt-5">
  <h3>কাস্টমার কে টাকা লোণ দিন</h3>
  <form id="loanForm">
    <div class="mb-3">
      <label for="customer" class="form-label">কাস্টমার নির্বাচন করুন</label>
      <select class="form-select" id="customer" required>
        <option value="">একটি কাস্টমার নির্বাচন করুন</option>
        <option value="customer1">কাস্টমার ১</option>
        <option value="customer2">কাস্টমার ২</option>
        <option value="customer3">কাস্টমার ৩</option>
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
      <label for="time" class="form-label">লোনের সময়</label>
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



             



@include('partials.footer')