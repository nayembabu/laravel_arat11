<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>

<div class="container mt-4">
    <form id="searchForm" class="row g-3 align-items-end">
        <div class="col-md-4">
            <label for="person" class="form-label">আমানত ব্যক্তি</label>
            <select class="form-select" id="person" name="person" required>
                <option value="">নির্বাচন করুন</option>
                <option value="person1">ব্যক্তি ১</option>
                <option value="person2">ব্যক্তি ২</option>
                <!-- আরও অপশন যোগ করুন -->
            </select>
        </div>
        <div class="col-md-3">
            <label for="start_date" class="form-label">শুরুর তারিখ</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        <div class="col-md-3">
            <label for="end_date" class="form-label">শেষ তারিখ</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">খুজুন</button>
        </div>
    </form>

    <div id="resultSection" class="mt-5" style="display:none;">
        <h5>ফলাফল</h5>
        <div class="table-responsive">
            <table class="table table-bordered align-middle table table-success table-striped">
                <thead class="table-light">
                    <tr>
                        <th>সিরিয়াল</th>
                        <th>তারিখ</th>
                        <th>সময়</th>
                        <th>মারফত</th>
                        <th>জমা</th>
                        <th>খরচ</th>
                    </tr>
                </thead>
                <tbody id="resultTableBody">
                    <!-- ডাটা এখানে আসবে -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function() {
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        // ডেমো ডাটা, AJAX দিয়ে ডাটা আনতে পারেন
        var demoData = [
            {serial: 1, date: '2024-06-01', time: '10:00', marfot: 'ব্যক্তি ১', deposit: 5000, expense: 0},
            {serial: 2, date: '2024-06-02', time: '12:30', marfot: 'ব্যক্তি ২', deposit: 0, expense: 2000}
        ];
        var tbody = '';
        $.each(demoData, function(i, row) {
            tbody += '<tr>'+
                '<td>'+(i+1)+'</td>'+
                '<td>'+row.date+'</td>'+
                '<td>'+row.time+'</td>'+
                '<td>'+row.marfot+'</td>'+
                '<td>'+row.deposit+'</td>'+
                '<td>'+row.expense+'</td>'+
            '</tr>';
        });
        $('#resultTableBody').html(tbody);
        $('#resultSection').show();
    });
});
</script>









<?php
    include 'partial/footer.php';
?>