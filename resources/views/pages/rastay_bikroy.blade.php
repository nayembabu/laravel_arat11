@include('partials.header')
@include('partials.topmenu')
@include('partials.sidebar')


<!-- Colorful, Gradient, Animated Sales Entry UI -->


<style>
    body {
        background: linear-gradient(-135deg, #5d5c5eff, #94febbff);
        font-family: "Segoe UI", sans-serif;
        min-height: 100vh;
        padding: 20px;
    }

    .card-glass {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        backdrop-filter: blur(12px);
        box-shadow: 0 8px 32px rgba(176, 77, 241, 0.2);
        color: #fff;
        padding: 20px;
        transition: 0.3s;
    }

    .card-glass:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 40px rgba(0, 0, 0, 0.4);
    }

    .btn-gradient {
        background: linear-gradient(45deg, #ff512f, #dd2476);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 10px 25px;
        margin: 5px;
        transition: 0.3s;
    }

    .btn-gradient:hover {
        transform: scale(1.1);
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.6);
    }

    .product-card {
        cursor: pointer;
        border: 2px solid transparent;
    }

    .product-card:hover {
        border: 2px solid #fff;
    }
</style>
</head>

<body>
    <div class="container">
        <h2 class="text-center text-white mb-4">✨ Smart Sales System</h2>

        <!-- Step 1: Selections -->
        <div class="card-glass mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">কাস্টমার নাম</label>
                    <select id="customerSelect" class="form-select select2">
                        <option value="">-- Select Customer --</option>
                        <option>Customer A</option>
                        <option>Customer B</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">বিক্রয়ের ধরন</label>
                    <select id="saleType" class="form-select select2">
                        <option value="">-- Select --</option>
                        <option>Direct</option>
                        <option>Commission</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">বিক্রয় তারিখ</label>
                    <input type="text" id="saleDate" class="form-control datepicker">
                </div>
                <div class="col-md-3">
                    <label class="form-label">পণ্য সিলেক্ট করুন</label>
                    <select id="productSelect" class="form-select select2">
                        <option value="">-- Select Product --</option>
                        <option>Product 1</option>
                        <option>Product 2</option>
                        <option>Product 3</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Step 2: Dynamic Buttons -->
        <div id="actionButtons" class="text-center d-none">
            <button class="btn btn-gradient action-btn">Show Product</button>
        </div>

        <!-- Step 3: Product Cards -->
        <div id="productCards" class="row mt-4 d-none">
            <div class="col-md-4">
                <div class="card-glass product-card text-center p-4">
                    <h5>📦 Product 1</h5>
                    <p>Click for details</p>
                </div>
            </div>
            <br>
        </div>
        <br><br>

        <!-- Step 4: Product Details -->
        <div id="productDetails" class="card-glass mt-4 d-none">
            <div class="row">
                <div class="col-md-8">
                    <h4>📑 Product Information</h4>
                    
                    <p>
                        <strong>পন্যের নাম:</strong> আলু (আলু)
                    </p>
                    <p>
                        <strong>স্টকে আছে:</strong> 120 কেজি
                    </p>
                    <p>
                        <strong>প্রতি কেজির কেনা দাম:</strong> ১০ টাকা
                    </p>
                    <p>
                        <strong>কেজি প্রতি খরচ:</strong> ৫ টাকা (যেমন: পরিবহন, শ্রমিক খরচ)
                    </p>
                    <p>
                        <strong>প্রতি কেজির মোট দাম:</strong> ৫ টাকা (কেনা দাম + খরচ)
                    </p>
                    <p>
                        <strong>মোট কেজি ছিলো:</strong> ১০ কেজি
                    </p>
                    <p>
                        <strong>১ বস্তাতে ছিলো:</strong> ৫ কেজি
                    </p>
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control mb-2" placeholder="পন্যের পরিমান">
                    <input type="number" class="form-control mb-2" placeholder="মোট কেজি">
                    <input type="text" class="form-control mb-2" placeholder="পন্যের দাম">
                    <button class="btn btn-gradient w-100">যোগ করুন  </button>
                </div>
                        <!-- হিসাব চেক Section -->
        <div class="card-glass mt-4">
            <h4 class="mb-3">📊 হিসাব চেক</h4>
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">মালের দাম (৳)</label>
                    <input type="number" class="form-control" placeholder="মালের দাম (৳)">
                </div>
                <div class="col-md-3">
                    <label class="form-label">লেবার খরচ (৳)</label>
                    <input type="number" class="form-control" placeholder="লেবার খরচ (৳)">
                </div>
                <div class="col-md-3">
                    <label class="form-label">ভাড়া (৳)</label>
                    <input type="number" class="form-control" placeholder="ভাড়া (৳)">
                </div>
                <div class="col-md-3">
                    <label class="form-label">বিক্রয় কারণ (৳)</label>
                    <input type="number" class="form-control" placeholder="বিক্রয় কারণ (৳)">
                </div>
                <div class="col-md-3">
                    <label class="form-label">কৈফিয়ত (৳)</label>
                    <input type="number" class="form-control" placeholder="কৈফিয়ত (৳)">
                </div>
                <div class="col-md-3">
                    <label class="form-label">সাবেক (৳)</label>
                    <input type="number" class="form-control" placeholder="কৈফিয়ত (৳)">
                </div>
                <div class="col-md-3">
                    <label class="form-label">মোট টাকা (৳)</label>
                    <input type="number" class="form-control" placeholder="কৈফিয়ত (৳)">
                </div>
                <div class="col-md-3">
                    <label class="form-label">জমা টাকা (৳)</label>
                    <input type="number" class="form-control" placeholder="কৈফিয়ত (৳)">
                </div>
                <div class="col-md-3">
                    <label class="form-label">বকেয়া টাকা (৳)</label>
                    <input type="number" class="form-control" placeholder="কৈফিয়ত (৳)">
                </div>
                <div class="col-md-3">
                    <label class="form-label">পরিশোধের মাধ্যম</label>
                    <select class="form-select">
                        <option value="">-- নির্বাচন করুন --</option>
                        <option>নগদ</option>
                        <option>বিকাশ</option>
                        <option>ব্যাংক</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">লেনদেন নোট</label>
                    <input type="text" class="form-control" placeholder="নোট">
                </div>
                <div class="col-md-3">
                    <label class="form-label">তারিখ</label>
                    <input type="text" class="form-control datepicker" placeholder="তারিখ">
                    <button class="btn btn-gradient w-100 mt-3">বিক্রয় সম্পন্ন করুন</button>
                </div>
            </div>
        </div>
            </div>
        </div>


    </div>



    <script>
        $(document).ready(function() {
            $('.select2').select2();

            // Step 1: Show buttons if all selected
            function checkStepReady() {
                if ($('#customerSelect').val() && $('#saleType').val() && $('#saleDate').val() && $('#productSelect').val()) {
                    $('#actionButtons').removeClass('d-none');
                }
            }
            $('#customerSelect, #saleType, #saleDate, #productSelect').on('change input', checkStepReady);

            // Step 2: Show product cards on button click
            $('.action-btn').click(function() {
                $('#productCards').removeClass('d-none');
                Swal.fire("Great!", "Now choose a product card!", "success");
            });

            // Step 3: Show details on product card click
            $('.product-card').click(function() {
                let productName = $(this).find("h5").text();

                let detailsHtml = `
    <p><strong>Product Name:</strong> ${productName}</p>
    <p><strong>Description:</strong> This is a high-quality ${productName} with premium features.</p>
    <p><strong>Stock:</strong> 120 pcs available</p>
    <p><strong>Warranty:</strong> 1 Year replacement warranty</p>
    <p><strong>Supplier:</strong> XYZ Traders Ltd.</p>
  `;

                $('#productInfo').html(detailsHtml);
                $('#productDetails').removeClass('d-none');
            });

        });
    </script>



@include('partials.footer')