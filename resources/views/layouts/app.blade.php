<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Encuesta')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
        }

        nav {
            background-color: #007bff;
            padding: 10px 0;
        }

        nav ul {
            display: flex;
            justify-content: center;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav li {
            margin: 0 15px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            padding: 8px 16px;
            border-radius: 5px;
        }

        nav a:hover {
            background-color: #0056b3;
        }

        footer {
            text-align: center;
            padding: 15px;
            background-color: #343a40;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .container {
            min-height: 80vh;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="/">Inicio</a></li>
            <li><a href="{{ route('clients.index') }}">Clientes</a></li>
            <li><a href="{{ route('vehicles.index') }}">Vehiculos</a></li>
        </ul>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>

    <footer>
        <p>Systema de encuesta - 2026</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>