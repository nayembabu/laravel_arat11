@include('partials.header')

<style>
    /* Friendly animated login styles (page-scoped) */
    .container.mt-4 {
        min-height: calc(100vh - 140px); /* accommodate header/footer */
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #f6fbff 0%, #eef6ff 60%);
        padding-top: 12px;
        padding-bottom: 12px;
    }

    /* Colorful floating blobs */
    .container.mt-4::before,
    .container.mt-4::after {
        content: '';
        position: absolute;
        width: 520px;
        height: 520px;
        border-radius: 50%;
        filter: blur(60px);
        opacity: 0.75;
        transform: translate3d(0,0,0);
        pointer-events: none;
    }
    .container.mt-4::before {
        left: -180px;
        top: -120px;
        background: radial-gradient(circle at 30% 30%, rgba(102,126,234,0.85), rgba(58,123,213,0.55) 40%, transparent 60%);
        animation: floatX 8s ease-in-out infinite alternate;
    }
    .container.mt-4::after {
        right: -160px;
        bottom: -140px;
        background: radial-gradient(circle at 70% 70%, rgba(0,200,255,0.75), rgba(0,150,255,0.4) 40%, transparent 60%);
        animation: floatY 10s ease-in-out infinite alternate;
    }

    @keyframes floatX {
        0% { transform: translateY(0) translateX(0) rotate(0deg); }
        100% { transform: translateY(18px) translateX(20px) rotate(9deg); }
    }
    @keyframes floatY {
        0% { transform: translateY(0) translateX(0) rotate(0deg); }
        100% { transform: translateY(-20px) translateX(-10px) rotate(-6deg); }
    }

    .container.mt-4 .row { width: 100%; }

    .container.mt-4 .col-md-6 {
        max-width: 560px;
        margin: 0 auto;
        z-index: 5; /* bring card above blobs */
    }

    .container.mt-4 .card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(12,34,63,0.12);
        transition: transform .35s ease, box-shadow .35s ease;
        transform-origin: center center;
        animation: popIn .6s cubic-bezier(.2,.9,.3,1) both;
        background: linear-gradient(180deg, rgba(255,255,255,0.96), rgba(250,252,255,0.9));
    }

    @keyframes popIn {
        0% { opacity: 0; transform: translateY(18px) scale(.995); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }

    .container.mt-4 .card:hover {
        transform: translateY(-8px) scale(1.01);
        box-shadow: 0 30px 80px rgba(12,34,63,0.18);
    }

    .container.mt-4 .card-header.bg-primary {
        background: linear-gradient(90deg,#6a8cff 0%,#4e73df 60%,#2b5bff 100%);
        border-bottom: none;
    }

    .container.mt-4 .form-control {
        transition: box-shadow .22s ease, border-color .18s ease, transform .2s ease;
    }
    .container.mt-4 .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 10px 30px rgba(46,102,255,0.06);
        transform: translateY(-1px);
    }

    /* Animated gradient button */
    .container.mt-4 .btn-primary {
        background: linear-gradient(90deg,#5aa0ff 0%,#36d1dc 50%,#4e73df 100%);
        background-size: 200% 100%;
        border: none;
        color: #fff;
        font-weight: 600;
        letter-spacing: .2px;
        transition: background-position .6s ease, transform .16s ease, box-shadow .24s ease;
        box-shadow: 0 10px 30px rgba(53,150,255,0.10);
    }
    .container.mt-4 .btn-primary:hover {
        background-position: 100% 0;
        transform: translateY(-3px) scale(1.01);
        box-shadow: 0 22px 54px rgba(53,150,255,0.16);
    }
    .container.mt-4 .btn-primary:active { transform: translateY(-1px) scale(.995); }

    /* tiny decorative pulse when button is focused via keyboard */
    .container.mt-4 .btn-primary:focus { 
        outline: none; box-shadow: 0 22px 54px rgba(53,150,255,0.18); 
    }

    .container.mt-4 a.small { 
        color: #05306b; 
    }

    @media (max-width: 576px) {
        .container.mt-4 { padding: 28px 12px; }
        .container.mt-4::before, .container.mt-4::after { display: none; }
    }
</style>

<div class="container mt-4">

    <div class="row justify-content-center">
        <h1 class="text-center">Login</h1>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-center">Login</h4>
                </div>
                <div class="card-body">
                    <form id="loginForm" method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="rememberMe" name="remember">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <div>
                                <a href="" class="small">Forgot password?</a>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button id="loginBtn" type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>

                    {{-- Minimal client-side logic: populate saved credentials and save/remove them on submit. No AJAX, no client-side error messages. --}}
                    <script>
                        (function(){
                            // Minimal JS - do not expose errors client-side. Backend handles auth/errors.
                            const form = document.getElementById('loginForm');
                            const emailEl = document.getElementById('email');
                            const passEl = document.getElementById('password');
                            const rememberEl = document.getElementById('rememberMe');

                            try {
                                const saved = JSON.parse(localStorage.getItem('laravel_login')) || {};
                                if (saved.email) emailEl.value = saved.email;
                                if (saved.password) passEl.value = saved.password; // storing password is insecure; you asked for saved login info
                                if (saved.remember) rememberEl.checked = true;
                            } catch (e) {
                                // silently ignore
                            }

                            form.addEventListener('submit', function(){
                                try {
                                    if (rememberEl.checked) {
                                        localStorage.setItem('laravel_login', JSON.stringify({
                                            email: emailEl.value,
                                            password: passEl.value,
                                            remember: true
                                        }));
                                    } else {
                                        localStorage.removeItem('laravel_login');
                                    }
                                } catch (e) {
                                    // ignore storage errors silently
                                }
                                // Let the form submit normally; backend will handle success/error and redirect.
                            });
                        })();
                    </script>