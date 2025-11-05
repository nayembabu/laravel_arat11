<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>
<div class="container mt-4">
    <h3>Please Insert Valid Data</h3>
    <form action="save_income.php" method="post">
        <div class="mb-3">
            <label for="income_date" class="form-label">ইনকামের তারিখ</label>
            <input type="date" class="form-control" id="income_date" name="income_date" required>
        </div>
        <div class="mb-3">
            <label for="income_reason" class="form-label">ইনকামের কারণ</label>
            <input type="text" class="form-control" id="income_reason" name="income_reason" required>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">পরিমাণ</label>
            <input type="number" class="form-control" id="amount" name="amount" min="0" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">সংরক্ষণ করুন</button>
        <a href="onnanno_income.php" class="btn btn-secondary">বন্ধ করুন</a>
    </form>
</div>

             

<?php
    include 'partial/footer.php';
?>