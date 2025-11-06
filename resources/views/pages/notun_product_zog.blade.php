@include('partials.header')
@include('partials.topmenu')
@include('partials.sidebar')


<div class="container mt-5">
    <form action="" method="post" class="mx-auto" style="max-width: 400px;">
        <div class="mb-3">
            <label for="product_code" class="form-label">পন্য কোড*</label>
            <input type="text" class="form-control" id="product_code" name="product_code" required>
        </div>
        <div class="mb-3">
            <label for="item_name" class="form-label">আইটেম নাম*</label>
            <input type="text" class="form-control" id="item_name" name="item_name" required>
        </div>
        <div class="mb-3">
            <label for="unit" class="form-label">একক </label>
            <select class="form-select" id="unit" name="unit" required>
                <option value="">-- নির্বাচন করুন --</option>
                <option value="কেজি">কেজি</option>
                <option value="মণ">মণ</option>
                <option value="গ্রাম">গ্রাম</option>
            </select>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-outline-danger">Save</button>
            <a href="#" class="btn btn-secondary">Close</a>
        </div>
    </form>
</div>

             



@include('partials.footer')