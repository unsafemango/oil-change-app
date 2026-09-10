<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title', 'Oil Change')</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  <div class="page">
    <header class="site-header">
      <h1><a href="{{ route('oil-change.create') }}">
        Oil Change
      </a></h1>
    </header>

    <main>@yield('content')</main>
  </div>
</body>
</html>