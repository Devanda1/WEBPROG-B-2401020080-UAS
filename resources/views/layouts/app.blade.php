<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'Laravel Game Project')</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Orbitron:wght@500;700&display=swap" rel="stylesheet">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f3f4f6;
    }

    h1, h2, h3 {
      font-family: 'Orbitron', sans-serif;
      font-weight: 700;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="/"> Game Data</a>
      <a href="{{ route('karakter.index') }}" class="btn btn-warning btn-sm">Daftar Karakter</a>
    </div>
  </nav>

  <main class="container py-4">
    @yield('content')
  </main>

  <footer class="text-center py-3 text-muted">
    © 2025 Laravel Game Project
  </footer>
</body>
</html>
