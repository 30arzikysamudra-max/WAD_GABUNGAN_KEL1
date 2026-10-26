<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Data Penerbit dan Supplier')</title>
  <link rel="stylesheet" href="{{ asset('css/gaya.css') }}">
  <style>
    .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px 15px; border-radius: 4px; margin: 10px 0; max-width: 600px; }
    .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px 15px; border-radius: 4px; margin: 10px 0; max-width: 600px; }
    .alert-error ul { margin: 0; padding-left: 20px; }
    .field-error { color: #c0392b; font-size: 13px; margin: -4px 0 8px; display: block; }
    form.inline { display: inline; }
    button.btn-hapus { border: none; cursor: pointer; font-family: inherit; }
  </style>
</head>
<body>

  @if (session('success'))
    <div class="alert-success">{{ session('success') }}</div>
  @endif

  @yield('content')

</body>
</html>
