
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trim($__env->yieldContent('title', config('app.name'))) }}</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-800">

    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10 bg-gradient-to-br from-violet-50 via-white to-purple-100 ">

        <!-- Project Branding -->
        <a href="/" class="mb-8 flex flex-col items-center gap-3">
            <img
                src="{{ asset('images/logo.svg') }}"
                alt="Student Timetable Tracker"
                class="w-24 h-24 object-contain"
            >

            <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-900">
                    Student <span class="text-violet-600">Timetable</span> Tracker
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Plan • Study • Achieve
                </p>
            </div>
        </a>

        <!-- Authentication Content -->
        <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-xl shadow-violet-100/60 rounded-2xl border border-violet-100">

            {{ $slot }}

        </div>

        <p class="mt-6 text-xs text-gray-400">
            © Psway97 {{ date('Y') }} Student Timetable Tracker
        </p>

    </div>

</body>
</html>
