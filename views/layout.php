<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <!-- Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Título dinámico -->
    <title><?= $title ?? 'Bodegas' ?></title>

    <!-- Bootstrap 5 (estilos) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (iconos) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<!-- Contenedor principal -->
<div class="container mt-5">
    <?= $content ?>
</div>

<!-- Bootstrap JS (incluye modals, alerts, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- JS personalizado -->
<script src="./js/app.js"></script>
</body>
</html>