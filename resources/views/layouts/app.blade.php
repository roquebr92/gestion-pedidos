<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Gestión de Pedidos')</title>

  {{-- 1) Vite: Tailwind + tus scripts --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- 2) Bootstrap 5 --}}
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
    crossorigin="anonymous"
  >

  {{-- 3) Font Awesome (si la necesitas) --}}
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    rel="stylesheet"
  >
</head>
<body class="bg-gray-100 min-h-screen">
  {{-- Contenedor principal --}}
  <div class="container py-8">
    @hasSection('title')
     {{-- Si hay sección title, mostramos el nav-tabs --}}
      @yield('tabs', '')
    @endif
    @yield('content')
  </div>

  {{-- Bootstrap Bundle (Popper incluido) --}}
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"
  ></script>
</body>
</html>
