@include('partials.header')
@include('partials.topmenu')
@include('partials.sidebar')


<div class="container mt-4">
  <!-- Card 1: Search Form -->
  <div class="card mb-4">
    <div class="card-header">
      Date to Date Search & Customer Selection
    </div>
    <div class="card-body">
      <form class="row g-3 align-items-end">
        <div class="col-md-4">
          <label for="from_date" class="form-label">From Date</label>
          <input type="date" class="form-control" id="from_date" name="from_date">
        </div>
        <div class="col-md-4">
          <label for="to_date" class="form-label">To Date</label>
          <input type="date" class="form-control" id="to_date" name="to_date">
        </div>
        <div class="col-md-4">
          <label for="customer" class="form-label">Customer</label>
          <select class="form-select" id="customer" name="customer">
            <option selected disabled>Select Customer</option>
            <option value="customer1">Customer 1</option>
            <option value="customer2">Customer 2</option>
            <option value="customer3">Customer 3</option>
          </select>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Show</button>
          <button type="reset" class="btn btn-secondary">Close</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Card 2: Customer Info -->
  <div class="card mb-4">
    <div class="card-header">
      Customer Information
    </div>
    <div class="card-body row">
      <div class="col-md-3">
        <strong>Customer Name:</strong> <span id="customer_name"></span>
      </div>
      <div class="col-md-3">
        <strong>Current Due:</strong> <span id="current_due">৳0</span>
      </div>

      <div class="col-md-3">
        <strong>Mobile:</strong> <span id="customer_mobile"></span>
      </div>
      <div class="col-md-3">
        <strong>Address:</strong> <span id="customer_address"></span>
      </div>
    </div>
  </div>

  <!-- Section 3: Table -->
  <div class="card">
    <div class="card-header">
      হিসাব তালিকা
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>SL</th>
            <th>বিক্রয় তারিখ</th>
            <th>বিস্তারিত</th>
            <th>আগের বকেয়া</th>
            <th>বিক্রিত পন্যের দাম</th>
            <th>খরচ</th>
            <th>জমা</th>
            <th>বর্তমান বকেয়া</th>
            <th>অপশন</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>2024-01-01</td>
            <td>Product A, Product B</td>
            <td>৳0</td>
            <td>৳500</td>
            <td>৳50</td>
            <td>৳300</td>
            <td>৳150</td>
            <td>
              <button class="btn btn-sm btn-warning">Edit</button>
              <button class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>2024-01-05</td>
            <td>Product C</td>
            <td>৳150</td>
            <td>৳200</td>
            <td>৳20</td>
            <td>৳100</td>
            <td>৳230</td>
            <td>
              <button class="btn btn-sm btn-warning">Edit</button>
              <button class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr>
          <tr>
            <td>3</td>
            <td>2024-01-10</td>
            <td>Product D, Product E</td>
            <td>৳230</td>
            <td>৳400</td>
            <td>৳30</td>
            <td>৳200</td>
            <td>৳460</td>
            <td>
              <button class="btn btn-sm btn-warning">Edit</button>
              <button class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr>
          

        </tbody>
      </table>
    </div>
  </div>
</div>



@include('partials.footer')

