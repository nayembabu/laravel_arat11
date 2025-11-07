@include('partials.header')
@include('partials.topmenu')
@include('partials.sidebar')


<div class="container mt-4">
    <form id="customerForm" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="customerName" class="form-label">আমদানীকারকের নাম</label>
            <input type="text" class="form-control" id="customerName" required>
        </div>
        <div class="col-md-4">
            <label for="mobile" class="form-label"> মোবাইল নাম্বার</label>
            <input type="text" class="form-control" id="mobile" required>
        </div>
        <div class="col-md-4">
            <label for="address" class="form-label"> ঠিকানা</label>
            <input type="text" class="form-control" id="address" required>
        </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary text-end">সংরক্ষণ করুন</button>
    </form>
</div>



@include('partials.footer')

