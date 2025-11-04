<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>
<center><h1>Add User Information</h1></center>
<div style="max-width: 500px; margin: 40px auto; background: linear-gradient(135deg, #f6d365 0%, #612f4aff 100%); border-radius: 18px; box-shadow: 0 8px 24px rgba(0,0,0,0.15); padding: 32px;">
    <h2 style="text-align:center; color:#fff; margin-bottom:24px; letter-spacing:1px;">নতুন আমানতের ব্যক্তি যোগ</h2>
    <form action="save_user.php" method="post" style="display:flex; flex-direction:column; gap:18px;">
        <label style="color:#fff; font-weight:bold;">
            নাম
            <input type="text" name="name" required style="width:100%; padding:10px; border-radius:8px; border:none; margin-top:6px;"/>
        </label>
        <label style="color:#fff; font-weight:bold;">
            ঠিকানা
            <input type="text" name="address" required style="width:100%; padding:10px; border-radius:8px; border:none; margin-top:6px;"/>
        </label>
        <label style="color:#fff; font-weight:bold;">
            হোয়াটসঅ্যাপ নম্বর
            <input type="text" name="whatsapp" required style="width:100%; padding:10px; border-radius:8px; border:none; margin-top:6px;"/>
        </label>
        <label style="color:#fff; font-weight:bold;">
            ফোন নম্বর
            <input type="text" name="phone" required style="width:100%; padding:10px; border-radius:8px; border:none; margin-top:6px;"/>
        </label>
        <button type="submit" style="background:linear-gradient(90deg,#43cea2 0%,#185a9d 100%); color:#fff; font-weight:bold; padding:12px; border:none; border-radius:8px; cursor:pointer; font-size:16px; margin-top:10px; transition:background 0.3s;">
            নতুন ব্যবহারকারী যোগ করুন
        </button>
    </form>
</div>
<?php
    include 'partial/footer.php';
?>