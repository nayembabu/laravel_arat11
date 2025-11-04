<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Placeholder' }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
    <div style="max-width:900px;margin:40px auto;font-family:Arial,Helvetica,sans-serif;">
        <h1 style="margin-bottom:8px;color:#333">Placeholder page</h1>
        <p style="margin:0 0 12px;color:#555">Route: <strong>{{ $title }}</strong></p>
        <p style="margin:0 0 18px;color:#666">This is a lightweight placeholder view. Replace with the real controller or Blade view for the route.</p>
        <p><a href="{{ url('/') }}" style="color:#0b66c3">← Back to home</a></p>
    </div>
</body>
</html>