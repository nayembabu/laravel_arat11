<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>

<div class="container mt-4">
    <h2>Create Staff Cost</h2>
    <form action="save_staff_cost.php" method="post">
        <div class="form-group mb-3">
            <label for="staff">Select Staff</label>
            <select class="form-control" id="staff" name="staff" required>
                <option value="">-- Select Staff --</option>
                <!-- Example static options, replace with dynamic PHP if needed -->
                <option value="1">John Doe</option>
                <option value="2">Jane Smith</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="amount">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" required min="0" step="0.01">
        </div>
        <div class="form-group mb-3">
            <label for="purpose">Purpose</label>
            <input type="text" class="form-control" id="purpose" name="purpose" required>
        </div>
        <div class="form-group mb-3">
            <label for="date">Date</label>
            <input type="text" class="form-control datepicker" id="currentDate" name="date" required>
        </div>
        <div class="form-group mb-3">
            <label for="time">Time</label>
            <input type="text" class="form-control" id="currentTime" name="time" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<?php
    include 'partial/footer.php';
?>

<script>
$(document).ready(function(){
    function updateTime() {
        let now = new Date();
        let hours = String(now.getHours()).padStart(2, '0');
        let minutes = String(now.getMinutes()).padStart(2, '0');
        let seconds = String(now.getSeconds()).padStart(2, '0');
        let timeString = hours + ":" + minutes + ":" + seconds;

        $("#currentTime").val(timeString);
    }

    updateTime();

    setInterval(updateTime, 1000);
});

$(document).ready(function(){
    let today = new Date();
    let day = String(today.getDate()).padStart(2, '0');
    let month = String(today.getMonth() + 1).padStart(2, '0'); 
    let year = today.getFullYear();

    let dateString = day +  "-" + month + "-" + year; 
    $("#currentDate").val(dateString);
});
</script>
