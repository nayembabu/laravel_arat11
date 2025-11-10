<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/notun_bikroy', function () {
    return view('pages.notun_bikroy2');
});
Route::get('/login', function () {
    return view('pages.login');
});
// Sidebar routes (generated from resources/views/partials/sidebar.blade.php)
$sidebarRoutes = [
    '/dashboard',
    '/bikroy_edit',
    '/rastay_bikroy',
    '/bikroy_koifiyot',
    '/bikroy_commission_entry',
    '/bikroy_commission_hishab',
    '/bikroy_return',
    '/bikroy_chalan',

    '/notun_kroy',
    '/kroy_edit',
    '/kroy_koifiyot',
    '/customer_kroy',
    '/kroy_commission_entry',
    '/kroy_commission_hishab',
    '/kroy_chalan',

    '/customer_er_taka_grohon',
    '/mohajon_theke_hawlat',
    '/onnanno_income',

    '/transport_amount_paid',
    '/mohajonke_porishud',
    '/customerke_hawlat_deya',
    '/onnanno_khoroc',

    '/notun_amanot_bekti',
    '/amanot_hishab',
    '/amanot_bistarito',

    '/index',
    '/customer_list',
    '/customer_hishab',

    '/notun_mohajon',
    '/mohajon_talika',
    '/mohajon_hishab',

    '/notun_product_zog',
    '/product_talika',

    '/notun_staff_zog',
    '/staff_list',
    '/staff_cost',
    '/staff_hishab',

    '/notun_transport',
    '/transport_list',
    '/transport_bistarito_hishab',

    '/customer_sms',
    '/amanoter_sms',
    '/mohajon_sms',

    '/lms',
    '/help-desk',
    '/crm',
    '/project_management',

    '/new_user',
    '/user_list',
    '/role_list',
];

foreach ($sidebarRoutes as $r) {
    
    Route::get($r, function () use ($r) {
        $view = 'pages.' . ltrim($r, '/');
        return view($view);
    });
}



