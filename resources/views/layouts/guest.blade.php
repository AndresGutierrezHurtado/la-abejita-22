<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary Meta Tags -->
    <title>@yield('title', 'Uniformes Escolares') | La Abejita 22 - Uniformes para Colegios en Bogotá</title>
    <meta name="title" content="@yield('meta_title', 'Uniformes Escolares La Abejita 22 - Los Mejores Uniformes para Colegios en Bogotá')">
    <meta name="description" content="@yield('meta_description', 'Encuentra los mejores uniformes escolares en Bogotá. La Abejita 22 ofrece uniformes de calidad para colegios con envío a domicilio. ¡Compra online!')">
    <meta name="keywords" content="@yield('meta_keywords', 'uniformes escolares, uniformes colegio, uniformes bogotá, la abejita 22, uniformes escolares bogotá, uniformes para colegios')">
    <meta name="author" content="Uniformes Escolares La Abejita 22">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Spanish">
    <meta name="revisit-after" content="7 days">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="@yield('favicon', asset('favicon.ico'))">

    <!-- Preconnect to external domains for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- traer css y js -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="w-full min-h-screen flex flex-col">
    @yield('navbar', '')

    <main class="flex-1">
        @yield('content')
    </main>

    @yield('footer', '')

    @yield('scripts')
</body>

</html>