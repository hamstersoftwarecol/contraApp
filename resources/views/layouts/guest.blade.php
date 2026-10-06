<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Custom Styles -->
        <style>
            [x-cloak] { display: none !important; }

            /* Perspectiva 3D */
            .perspective {
                perspective: 1000px;
            }

            .transform-3d {
                transform-style: preserve-3d;
            }

            /* Efectos de glassmorphism mejorados */
            .glass {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.18);
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            }

            /* Efectos de profundidad */
            .depth-effect {
                box-shadow: 
                    0 2.8px 2.2px rgba(0, 0, 0, 0.034),
                    0 6.7px 5.3px rgba(0, 0, 0, 0.048),
                    0 12.5px 10px rgba(0, 0, 0, 0.06),
                    0 22.3px 17.9px rgba(0, 0, 0, 0.072),
                    0 41.8px 33.4px rgba(0, 0, 0, 0.086),
                    0 100px 80px rgba(0, 0, 0, 0.12);
            }

            /* Animaciones suaves */
            .hover-float {
                transition: transform 0.3s ease-in-out;
            }

            .hover-float:hover {
                transform: translateY(-10px) rotateX(5deg) rotateY(5deg);
            }

            /* Gradientes animados */
            @keyframes gradient {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }

            .animated-gradient {
                background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
                background-size: 400% 400%;
                animation: gradient 15s ease infinite;
            }

            /* Efectos de luz */
            .light-effect {
                position: relative;
                overflow: hidden;
            }

            .light-effect::before {
                content: '';
                position: absolute;
                top: -50%;
                left: -50%;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
                transform: rotate(30deg);
                pointer-events: none;
            }

            /* Efecto de partículas */
            #particles-js {
                position: absolute;
                width: 100%;
                height: 100%;
                z-index: 1;
            }

            /* Contenido principal */
            .content-wrapper {
                position: relative;
                z-index: 2;
            }
        </style>
    </head>
    <body class="h-full font-sans antialiased">
        <div class="min-h-screen animated-gradient relative overflow-hidden">
            <!-- Efecto de partículas -->
            <div id="particles-js" class="absolute inset-0"></div>

            <!-- Contenido principal -->
            <div class="content-wrapper min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
                <div class="perspective w-full sm:max-w-md px-6 py-4">
                    <div class="transform-3d glass depth-effect hover-float light-effect rounded-2xl p-6">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
        <script>
            particlesJS('particles-js', {
                particles: {
                    number: { value: 100, density: { enable: true, value_area: 800 } },
                    color: { value: '#ffffff' },
                    shape: { type: 'circle' },
                    opacity: {
                        value: 0.5,
                        random: true,
                        animation: { enable: true, speed: 1, minimumValue: 0.1, sync: false }
                    },
                    size: {
                        value: 3,
                        random: true,
                        animation: { enable: true, speed: 2, minimumValue: 0.1, sync: false }
                    },
                    line_linked: {
                        enable: true,
                        distance: 150,
                        color: '#ffffff',
                        opacity: 0.4,
                        width: 1
                    },
                    move: {
                        enable: true,
                        speed: 2,
                        direction: 'none',
                        random: false,
                        straight: false,
                        out_mode: 'out',
                        bounce: false,
                    }
                },
                interactivity: {
                    detect_on: 'canvas',
                    events: {
                        onhover: { enable: true, mode: 'repulse' },
                        onclick: { enable: true, mode: 'push' },
                        resize: true
                    },
                    modes: {
                        repulse: { distance: 100, duration: 0.4 },
                        push: { particles_nb: 4 }
                    }
                },
                retina_detect: true
            });
        </script>
        @stack('scripts')
    </body>
</html>
 