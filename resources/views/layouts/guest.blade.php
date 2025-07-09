<!DOCTYPE html>
<html lang="es" data-theme="gourmet">

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

    <!-- Bring css and js -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="../../../node_modules/flyonui/flyonui.js"></script>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400..700;1,400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Russo+One&display=swap" rel="stylesheet">
</head>

<body class="w-full min-h-screen flex flex-col bg-base-100 text-base-content">
    @yield('navbar', '')

    <main class="flex-1 flex flex-col">
        @yield('content')
    </main>

    @yield('footer', '')

    <script src="../../../node_modules/flyonui/flyonui.js"></script>
    @yield('scripts')
</body>

</html>