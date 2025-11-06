@include('partials.header')
@include('partials.topmenu')
@include('partials.sidebar')


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dynamic Customer Form</title>
</head>
<body class="bg-light p-4">

  <div class="container">
    <h3 class="mb-4">Customer Payment Form</h3>
    
    <div class="mb-3">
      <label for="customerSelect" class="form-label">Select Customer</label>
      <select id="customerSelect" class="form-select">
        <option value="">-- Please Select --</option>
        <option value="1">Shajahan --- Narayanganj</option>
        <option value="2">Rahim --- Dhaka</option>
        <option value="3">Karim --- Chattogram</option>
      </select>
    </div>

    <form id="customerForm" style="display:none;">
      <div class="row mb-3">
        <div class="col">
          <label class="form-label">Name</label>
          <input type="text" id="name" class="form-control" readonly>
        </div>
        <div class="col">
          <label class="form-label">Phone Number</label>
          <input type="text" id="phone" class="form-control" readonly>
        </div>
        <div class="col">
          <label class="form-label">Total Due</label>
          <input type="text" id="due" class="form-control" readonly>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Address</label>
        <input type="text" id="address" class="form-control" readonly>
      </div>

      <div class="row mb-3">
        <div class="col">
          <label class="form-label">Payment Date</label>
          <input type="date" id="paymentDate" class="form-control">
        </div>
        <div class="col">
          <label class="form-label">Time</label>
          <input type="time" id="time" class="form-control">
        </div>
        <div class="col">
          <label class="form-label">Payment Method</label>
          <input type="text" id="method" class="form-control">
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <script>
    const customers = {
      1: { name: "Shajahan", phone: "01730949753", address: "Narayanganj", due: "524951.50", method: "Cash" },
      2: { name: "Rahim", phone: "01812345678", address: "Dhaka", due: "10000.00", method: "Bank Transfer" },
      3: { name: "Karim", phone: "01987654321", address: "Chattogram", due: "5000.00", method: "Bkash" }
    };

    $(function() {
      $("#customerSelect").on("change", function() {
        const id = $(this).val();
        if (id && customers[id]) {
          $("#customerForm").slideDown();
          $("#name").val(customers[id].name);
          $("#phone").val(customers[id].phone);
          $("#address").val(customers[id].address);
          $("#due").val(customers[id].due);
          $("#method").val(customers[id].method);

          const today = new Date().toISOString().split("T")[0];
          $("#paymentDate").val(today);

          const now = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
          $("#time").val(now);
        } else {
          $("#customerForm").slideUp().trigger("reset");
        }
      });

      $("#customerForm").on("submit", function(e) {
        e.preventDefault();
        alert("Form submitted successfully!");
      });
    });
  </script>
</body>
</html>






@include('partials.footer')