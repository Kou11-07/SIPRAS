<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sipras')</title>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js untuk interaktivitas sederhana -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Google Fonts - Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Terapkan Montserrat ke SEMUA elemen */
        * {
            font-family: 'Montserrat', sans-serif !important;
        }

        /* Atur ketebalan font untuk elemen tertentu (opsional) */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
            /* Bold untuk judul */
        }

        label {
            font-weight: 500;
            /* Medium untuk label */
        }

        input,
        button,
        p,
        a,
        span,
        div {
            font-weight: 400;
            /* Regular untuk teks biasa */
        }

        .font-light {
            font-weight: 300;
            /* Light */
        }

        .font-semibold {
            font-weight: 600;
            /* Semi Bold */
        }

        .font-bold {
            font-weight: 700;
            /* Bold */
        }

        .font-extrabold {
            font-weight: 800;
            /* Extra Bold */
        }

        #totalAngka {
            display: inline-block;
            transition: all 0.3s ease;
        }

        /* Animasi bounce untuk panah */
        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(5px);
            }
        }

        .animate-bounce {
            animation: bounce 1s ease-in-out infinite;
        }

        /* Hilangkan animasi bounce saat di-hover */
        .animate-bounce:hover {
            animation-play-state: paused;
        }

        /* Additional responsive adjustments */
        @media (max-width: 640px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            /* Prevent body scroll when modal is open */
            body.modal-open {
                overflow: hidden;
            }
        }

        @media (min-width: 1536px) {
            .container {
                max-width: 1280px;
            }
        }

        /* Smooth transitions */
        #mapContainer img {
            transition: transform 0.3s ease;
        }

        /* Modal animation */
        #mapModal {
            transition: opacity 0.3s ease;
        }

        #mapModal.show {
            display: flex;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body class="m-0 antialiased bg-white">
    <div class="min-h-screen">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>
    @stack('scripts')
</body>

</html>
