<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<h1> Detalle del registro {{ $enlace['Name'] ?? $n1 }}</h1>
    <p>
        Explicacion {{ $enlace['Description'] ?? 'Sin descripción' }}
    </p>
<button href="/api">Regresar</button>
</body>
</html>
