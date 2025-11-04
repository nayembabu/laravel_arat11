<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>

<div class="container mt-4">
    <div class="row g-4">
        <!-- আজকের মোট ক্রয় -->
        <div class="col-md-3">
            <div class="card shadow-sm border-3 h-100">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-shopping-bag fs-2 text-primary"></i>
                    </div>
                    <h6 class="card-title">আজকের মোট ক্রয়</h6>
                    <h3 class="fw-bold text-primary">
                        <?php echo number_format(0); ?>
                    </h3>
                </div>
            </div>
        </div>
        <!-- আজ পেমেন্ট প্রাপ্ত হয়েছে -->
        <div class="col-md-3">
            <div class="card shadow-sm border-3 h-100">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-coins fs-2 text-success"></i>
                    </div>
                    <h6 class="card-title">আজ পেমেন্ট প্রাপ্ত হয়েছে</h6>
                    <h3 class="fw-bold text-success">
                        <?php echo number_format(0); ?>
                    </h3>
                </div>
            </div>
        </div>
        <!-- আজকের মোট বিক্রয় -->
        <div class="col-md-3">
            <div class="card shadow-sm border-3 h-100">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-shopping-cart fs-2 text-warning"></i>
                    </div>
                    <h6 class="card-title">আজকের মোট বিক্রয়</h6>
                    <h3 class="fw-bold text-warning">
                        <?php echo number_format(0); ?>
                    </h3>
                </div>
            </div>
        </div>
        <!-- আজকের মোট ব্যয় -->
        <div class="col-md-3">
            <div class="card shadow-sm border-3 h-100">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <i class="fas fa-credit-card fs-2 text-danger"></i>
                    </div>
                    <h6 class="card-title">আজকের মোট ব্যয়</h6>
                    <h3 class="fw-bold text-danger">
                        <?php echo number_format(0); ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mt-4">
    <div class="row g-4">
        <!-- কাস্টমার উইথ নাম্বার -->
        <div class="col-md-3">
            <a href="customer_list.php" class="text-decoration-none">
                <div class="card shadow-sm border-3 h-100">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="fas fa-users fs-2 text-info"></i>
                        </div>
                        <h6 class="card-title">কাস্টমার</h6>
                        <h3 class="fw-bold text-info">
                            <?php echo number_format(0); ?>
                        </h3>
                    </div>
                </div>
            </a>
        </div>
        <!-- মহাজন উইথ নাম্বার -->
        <div class="col-md-3">
            <a href="mahajon_list.php" class="text-decoration-none">
                <div class="card shadow-sm border-3 h-100">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="fas fa-user-tie fs-2 text-secondary"></i>
                        </div>
                        <h6 class="card-title">মহাজন</h6>
                        <h3 class="fw-bold text-secondary">
                            <?php echo number_format(0); ?>
                        </h3>
                    </div>
                </div>
            </a>
        </div>
        <!-- ক্রয় চালান উইথ নাম্বার -->
        <div class="col-md-3">
            <a href="kroy_chalan.php" class="text-decoration-none">
                <div class="card shadow-sm border-3 h-100">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="fas fa-file-invoice-dollar fs-2 text-primary"></i>
                        </div>
                        <h6 class="card-title">ক্রয় চালান</h6>
                        <h3 class="fw-bold text-primary">
                            <?php echo number_format(0); ?>
                        </h3>
                    </div>
                </div>
            </a>
        </div>
        <!-- বিক্রয় চালান উইথ নাম্বার -->
        <div class="col-md-3">
            <a href="bikroy_chalan.php" class="text-decoration-none">
                <div class="card shadow-sm border-3 h-100">
                    <div class="card-body text-center">
                        <div class="mb-2">
                            <i class="fas fa-file-invoice fs-2 text-success"></i>
                        </div>
                        <h6 class="card-title">বিক্রয় চালান</h6>
                        <h3 class="fw-bold text-success">
                            <?php echo number_format(0); ?>
                        </h3>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="container mt-4">
    <h1>স্টক সতর্কতা</h1>
    <table class="table">
        <thead>
            <tr>
                <th>সিরিয়াল</th>
                <th>আইটেম এর নাম</th>
                <th>বিভাগ নাম</th>
                <th>স্টক পরিমাণ</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>১</td>
                <td>পণ্য ১</td>
                <td>বিভাগ ১</td>
                <td>১০</td>
            </tr>
            <tr>
                
            </tr>
        </tbody>
    </table>


<?php
    include 'partial/footer.php';
?>
