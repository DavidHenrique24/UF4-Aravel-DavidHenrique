<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Peliculas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('peliculas.index', [], true) }}">Peliculas</a>
            <a class="btn btn-primary" href="{{ route('peliculas.create', [], true) }}">Agregar Peliculas</a>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

</body>
</html>
