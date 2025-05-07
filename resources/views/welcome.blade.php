<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Bienvenido</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-start justify-center p-4">
  <div class="w-full max-w-5xl bg-white rounded-2xl shadow-lg overflow-hidden mt-8 pb-20" x-data="{ selected: null }">

    <!-- Cabecera -->
    <div class="bg-gradient-to-b from-gray-300 to-gray-100 py-6 px-8 flex items-center justify-between">
      <div>
        <h1 class="text-4xl font-bold text-gray-800">Bienvenido</h1>
        <p class="mt-2 text-lg text-gray-600">Selecciona tu empresa</p>
      </div>
      {{-- Logo Navacreus comentado --}}
    </div>

    <!-- Logos en línea flex -->
    <div class="px-8 py-10 flex flex-nowrap justify-center items-center space-x-16 overflow-x-auto">
      @foreach($companies as $empresa)
        <div
          class="flex-shrink-0 bg-white rounded-xl border-4 border-transparent cursor-pointer p-6 flex items-center justify-center transition select-none"
          :class="selected === {{ $empresa->id }} ? 'border-blue-600 ring-4 ring-blue-200' : ''"
          @click="selected = {{ $empresa->id }}"
        >
          <img
            src="{{ asset($empresa->logo_url) }}"
            alt="{{ $empresa->nombre }}"
            class="w-24 h-auto object-contain"
            style="max-height: 80px;"
          >
        </div>
      @endforeach
    </div>

    <!-- Botón Siguiente -->
    <div class="bg-gray-100 text-center pt-12">
      <button
        class="px-16 py-6 bg-blue-600 text-white text-xl font-semibold rounded-2xl shadow-lg disabled:opacity-50 disabled:cursor-not-allowed transition-all"
        :disabled="!selected"
        @click="if(selected) window.location.href = `/login?empresa_id=${selected}`"
      >
        Siguiente &rarr;
      </button>
    </div>

  </div>
</body>
</html>














