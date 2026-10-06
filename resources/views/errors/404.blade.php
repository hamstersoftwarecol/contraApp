<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada - Sistema de Pagos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">
    <main class="min-h-full bg-white">
        <div class="mx-auto max-w-7xl px-6 py-32 text-center sm:py-40 lg:px-8">
            <p class="text-base font-semibold leading-8 text-indigo-600">404</p>
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Página no encontrada</h1>
            <p class="mt-4 text-base text-gray-600 sm:mt-6">Lo sentimos, no pudimos encontrar la página que estás buscando.</p>
            <div class="mt-10 flex justify-center">
                <a href="{{ route('dashboard') }}" class="text-sm font-semibold leading-7 text-indigo-600">
                    <span aria-hidden="true">&larr;</span> Volver al inicio
                </a>
            </div>
            
            <!-- Ilustración -->
            <div class="mt-8 flex justify-center">
                <svg class="h-64 w-auto text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M8 15s1.5 2 4 2 4-2 4-2"/>
                    <line x1="9" y1="9" x2="9.01" y2="9"/>
                    <line x1="15" y1="9" x2="15.01" y2="9"/>
                </svg>
            </div>

            <!-- Sugerencias -->
            <div class="mt-8 text-center">
                <h2 class="text-lg font-semibold text-gray-900">Sugerencias:</h2>
                <ul class="mt-4 space-y-2 text-sm text-gray-600">
                    <li>Verifica que la URL esté escrita correctamente</li>
                    <li>Regresa a la página anterior</li>
                    <li>Utiliza la barra de navegación para encontrar lo que buscas</li>
                </ul>
            </div>

            <!-- Enlaces útiles -->
            <div class="mt-8 flex justify-center space-x-6">
                <a href="javascript:history.back()" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Volver atrás
                </a>
            </div>
        </div>
    </main>
</body>
</html> 