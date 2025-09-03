<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }} | Bienvenido</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css') {{-- Si usas Vite con Tailwind --}}
</head>
<body class="bg-white text-gray-800 font-sans">

    <!-- Hero -->
    <section class="relative bg-indigo-600 text-white">
        <div class="max-w-7xl mx-auto px-6 py-20 text-center">
            <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                Bienvenido a {{ config('app.name') }}
            </h1>
            <p class="mt-4 text-lg md:text-xl">
                Una solución moderna y poderosa para potenciar tu negocio o idea.
            </p>
            <div class="mt-8 flex justify-center space-x-4">
                <a href="{{ route('login') }}" class="bg-white text-indigo-600 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition">
                    Iniciar Sesión
                </a>
                <a href="#" class="border border-white text-white font-semibold px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
                    Saber más
                </a>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">¿Qué ofrece {{ config('app.name') }}?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <div class="text-indigo-600 mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Fácil de usar</h3>
                    <p>Interfaz intuitiva que se adapta a todos los niveles de experiencia.</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <div class="text-indigo-600 mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 17v-6h13V7H9V1L1 9l8 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Escalable</h3>
                    <p>Construido con Laravel, ideal para crecer sin límites.</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6 text-center">
                    <div class="text-indigo-600 mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Seguridad</h3>
                    <p>Protege tus datos con autenticación y buenas prácticas modernas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100 py-6 text-center text-sm text-gray-600">
        &copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
    </footer>

</body>
</html>
