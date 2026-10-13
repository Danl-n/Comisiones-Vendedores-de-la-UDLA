<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title', 'Minicore Comisiones')</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  <!-- Header con logo y título -->
  <header class="bg-red-800 text-white">
    <div class="max-w-5xl mx-auto flex items-center py-3 px-6 space-x-4">
      <img src="{{ asset('images/udla.png') }}"
           alt="Logo UDLA"
           class="h-10 bg-white rounded p-1">
      <div>
        <h1 class="text-xl font-bold">@yield('title', 'Comisiones Vendedores de la UDLA')</h1>
        <p class="text-xs text-red-100">Ejercicio MVC - Ingeniería Web</p>
      </div>
    </div>
  </header>

  <!-- Main content -->
  <main class="max-w-5xl mx-auto mt-6 px-6">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="mt-12 mb-6 text-center text-sm text-gray-600">
    &copy; {{ date('Y') }} — Universidad de las Américas
  </footer>

</body>
</html>
