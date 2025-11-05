<?php
    include 'partial/header.php';
    include 'partial/sidebar.php';
    include 'partial/topmenu.php';
?>

<style>
  /* ===== Colorful Animated Gradient Background ===== */
  .gradient-bg {
    min-height: 100vh;
    background: linear-gradient(135deg, #7f5af0, #00d4ff, #ff4d6d, #ffd166);
    background-size: 300% 300%;
    animation: hueShift 18s ease infinite;
  }
  @keyframes hueShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  /* ===== Glassmorphism Card ===== */
  .glass-card {
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.25);
    box-shadow: 0 20px 40px rgba(0,0,0,0.18);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 1.25rem;
  }

  /* ===== Gradient Text ===== */
  .gradient-text {
    background: linear-gradient(90deg, #f72585, #7209b7, #3a0ca3, #4361ee, #4cc9f0);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    font-weight: 800;
    letter-spacing: .5px;
  }

  /* ===== Fancy Buttons ===== */
  .btn-gradient {
    border: none !important;
    color: #fff !important;
    background: linear-gradient(135deg, #06d6a0, #118ab2);
    transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
    box-shadow: 0 10px 22px rgba(17,138,178,.35);
  }
  .btn-gradient:hover { transform: translateY(-2px); filter: brightness(1.05); }
  .btn-outline-fancy {
    border: 2px solid transparent;
    background: linear-gradient(#0000,#0000) padding-box, linear-gradient(135deg,#ff4d6d,#ffd166) border-box;
    color: #fff;
  }

  /* ===== Inputs focus glow ===== */
  .form-control:focus, .form-select:focus {
    box-shadow: 0 0 0 .25rem rgba(67,97,238,.35);
    border-color: #4361ee;
  }

  /* ===== Image preview ring ===== */
  .preview-ring {
    border-radius: 1rem;
    padding: .25rem;
    background: linear-gradient(135deg, #ff006e, #8338ec, #3a86ff);
    animation: ringPulse 4s ease-in-out infinite;
    display: inline-block;
  }
  @keyframes ringPulse {
    0%,100% { filter: saturate(1); }
    50%     { filter: saturate(1.4); }
  }

  /* ===== Password strength meter ===== */
  .strength-bar { height: 8px; border-radius: 6px; background: #eee; overflow: hidden; }
  .strength-fill { height: 100%; width: 0%; background: linear-gradient(90deg,#ef476f,#ffd166,#06d6a0); transition: width .25s ease; }

  /* ===== DataTable card tweaks ===== */
  .table-card thead th { background: linear-gradient(90deg,#4361ee,#4cc9f0); color:#fff; border: none; }
  .table-card tbody tr { backdrop-filter: blur(3px); }

  /* ===== Select2 fixes: keep dropdown right below */
  .select2-container{ width:100%!important; }
  .select2-container .select2-dropdown{ z-index: 3000; margin-top: 4px; }
</style>

<div class="gradient-bg py-5">
  <div class="container">

    <!-- ===== Add User Card ===== -->
    <div id="userCard" class="glass-card p-4 p-md-5 mb-5">
      <div class="d-flex align-items-center mb-4">
        <div class="me-3 rounded-circle" style="width:14px;height:14px;background:linear-gradient(135deg,#ff4d6d,#ffd166);"></div>
        <h2 class="m-0 gradient-text">Add New User</h2>
      </div>

      <form id="addUserForm" action="" method="post" enctype="multipart/form-data" novalidate>
        <div class="row g-4">
          <div class="col-md-6">
            <label for="username" class="form-label text-white-50">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="e.g., Sumon Ahmed" required>
          </div>
          <div class="col-md-6">
            <label for="number" class="form-label text-white-50">Number</label>
            <input type="text" class="form-control" id="number" name="number" placeholder="01XXXXXXXXX" required>
          </div>
          <div class="col-md-6">
            <label for="email" class="form-label text-white-50">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
          </div>

          <div class="col-md-6 position-relative">
            <label for="role" class="form-label text-white-50">Role</label>
            <select class="form-select select2" id="role" name="role" required>
              <option value="user">User</option>
              <option value="admin">Admin</option>
            </select>
          </div>

          <div class="col-md-6">
            <label for="password" class="form-label text-white-50">Password</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" name="password" required>
              <button class="btn btn-outline-fancy" type="button" id="togglePass"><i class="bi bi-eye"></i></button>
            </div>
            <div class="mt-2 strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
            <small id="strengthText" class="text-white-50"></small>
          </div>

          <div class="col-md-6">
            <label for="retype_password" class="form-label text-white-50">Retype Password</label>
            <input type="password" class="form-control" id="retype_password" name="retype_password" required>
            <small id="matchText" class="text-white-50"></small>
          </div>

          <div class="col-md-6">
            <label for="picture" class="form-label text-white-50">Picture</label>
            <input type="file" class="form-control" id="picture" name="picture" accept="image/*" required>
            <div class="mt-3" id="previewWrap" style="display:none;">
              <span class="preview-ring"><img id="previewImage" src="" alt="Preview" class="img-fluid rounded-3" style="max-width: 200px;"></span>
            </div>
          </div>
        </div>

        <div class="d-flex gap-3 mt-4">
          <button type="submit" id="addUserBtn" class="btn btn-gradient px-4">
            <i class="bi bi-person-plus me-1"></i> Add User
          </button>
          <button type="button" class="btn btn-outline-fancy px-4" id="closeFormBtn">
            <i class="bi bi-x-circle me-1"></i> Close
          </button>
        </div>
      </form>
    </div>

    <!-- ===== Optional: Existing Users DataTable (demo markup; hook up to backend) ===== -->
    <!-- <div class="glass-card p-4 table-card">
      <div class="d-flex align-items-center mb-3">
        <div class="me-2 rounded-circle" style="width:10px;height:10px;background:linear-gradient(135deg,#06d6a0,#118ab2);"></div>
        <h5 class="m-0 text-white">Existing Users</h5>
      </div>
      <div class="table-responsive">
        <table id="usersTable" class="table align-middle table-borderless text-white-50 w-100">
          <thead>
            <tr>
              <th>Name</th>
              <th>Number</th>
              <th>Email</th>
              <th>Role</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>Demo User</td><td>01700000000</td><td>demo@example.com</td><td>User</td></tr>
            <tr><td>Admin One</td><td>01800000000</td><td>admin@example.com</td><td>Admin</td></tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div> -->

<script>


  function passwordStrength(pw) {
    let score = 0;
    if (!pw) return 0;
    if (pw.length >= 8) score += 1;
    if (/[A-Z]/.test(pw)) score += 1;
    if (/[a-z]/.test(pw)) score += 1;
    if (/[0-9]/.test(pw)) score += 1;
    if (/[^A-Za-z0-9]/.test(pw)) score += 1;
    return Math.min(score, 5);
  }



    $('#usersTable').DataTable({
      pageLength: 5,
      lengthChange: false,
      language: { search: "Search:" }
    });

    $('#picture').on('change', function(evt) {
      const [file] = evt.target.files;
      if (file) {
        const url = URL.createObjectURL(file);
        $('#previewImage').attr('src', url);
        $('#previewWrap').fadeIn(200);
      }
    });

    // ===== Toggle Password Visibility =====
    $('#togglePass').on('click', function() {
      const input = $('#password');
      const type = input.attr('type') === 'password' ? 'text' : 'password';
      input.attr('type', type);
      $(this).find('i').toggleClass('bi-eye bi-eye-slash');
    });

    // ===== Live Strength + Match =====
    $('#password').on('input', function() {
      const pw = this.value;
      const score = passwordStrength(pw);
      const percent = (score / 5) * 100;
      $('#strengthFill').css('width', percent + '%');
      const text = ['Very Weak','Weak','Medium','Strong','Very Strong'];
      $('#strengthText').text(pw ? text[Math.max(0, score-1)] : '');
    });

    $('#retype_password, #password').on('input', function() {
      const match = $('#password').val() && $('#password').val() === $('#retype_password').val();
      $('#matchText').text(match ? 'Passwords match ✅' : ( $('#retype_password').val() ? 'Passwords do not match ❌' : ''));
      $('#matchText').toggleClass('text-success', match).toggleClass('text-danger', !match);
    });

    // ===== Close Button =====
    $('#closeFormBtn').on('click', function(){
      // Collapse card nicely
      $('#userCard').slideUp(250);
    });

    // ===== Submit Handling + SweetAlert =====
    $('#addUserForm').on('submit', function(e){
      e.preventDefault();
      const form = this;

      // Basic validation
      if (!form.checkValidity()) {
        Swal.fire({
          title: 'ফর্ম অসম্পূর্ণ',
          text: 'সব প্রয়োজনীয় ঘর পূরণ করুন।',
          icon: 'warning',
          confirmButtonText: 'ঠিক আছে'
        });
        return;
      }

      // Password checks
      const pw = $('#password').val();
      const re = $('#retype_password').val();
      if (pw !== re) {
        Swal.fire({
          title: 'পাসওয়ার্ড মিলেনি',
          text: 'দয়া করে একই পাসওয়ার্ড দিন।',
          icon: 'error',
          confirmButtonText: 'ঠিক আছে'
        });
        return;
      }

      Swal.fire({
        title: 'Confirm Add User',
        text: 'আপনি কি নতুন ব্যবহারকারী যোগ করতে চান?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'হ্যাঁ, যোগ করুন',
        cancelButtonText: 'বাতিল'
      }).then((result) => {
        if (result.isConfirmed) {
          // Optional: show success then submit
          Swal.fire({
            title: 'Success!',
            text: 'নতুন ব্যবহারকারী সফলভাবে যোগ করা হয়েছে!',
            icon: 'success',
            confirmButtonText: 'ঠিক আছে'
          }).then(() => {
            // Actually submit to server (remove this line if you only want JS handling)
            form.submit();
          });
        }
      });
    });
  });
</script>

<?php
    include 'partial/footer.php';
?>
