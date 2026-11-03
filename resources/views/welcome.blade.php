<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Time Table Tracker') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
                /* Custom minimal theme + layout utilities (extended) */
                @layer theme {
                    :root, :host {
                        --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
                        --color-red-50: #fef2f2;
                        --color-red-600: #dc2626;
                        --color-gray-50: #f9fafb;
                        --color-gray-100: #f3f4f6;
                        --color-gray-200: #e5e7eb;
                        --color-gray-600: #4b5563;
                        --color-gray-800: #1f2937;
                        --color-gray-900: #111827;
                        --color-white: #fff;
                        --color-black: #000;
                        --spacing: 0.25rem;
                        --text-xs: 0.75rem;
                        --text-sm: 0.875rem;
                        --text-base: 1rem;
                        --text-lg: 1.125rem;
                        --text-xl: 1.25rem;
                        --text-2xl: 1.5rem;
                        --text-3xl: 1.875rem;
                        --text-4xl: 2.25rem;
                        --font-weight-medium: 500;
                        --font-weight-semibold: 600;
                        --font-weight-bold: 700;
                        --radius-sm: 0.25rem;
                        --radius-md: 0.375rem;
                        --radius-lg: 0.5rem;
                        --radius-xl: 0.75rem;
                        --radius-2xl: 1rem;
                        --shadow-sm: 0 1px 3px 0 #0000001a, 0 1px 2px -1px #0000001a;
                        --shadow-md: 0 4px 6px -1px #0000001a, 0 2px 4px -2px #0000001a;
                        --shadow-lg: 0 10px 15px -3px #0000001a, 0 4px 6px -4px #0000001a;
                        --default-font-family: var(--font-sans);
                    }
                }
                @layer base {
                    *, :after, :before {
                        box-sizing: border-box;
                        border: 0 solid;
                        margin: 0;
                        padding: 0;
                    }
                    html, :host {
                        line-height: 1.5;
                        font-family: var(--default-font-family, ui-sans-serif, system-ui, sans-serif);
                        -webkit-text-size-adjust: 100%;
                        -moz-tab-size: 4;
                        tab-size: 4;
                    }
                    body { line-height: inherit; }
                    h1, h2, h3, h4, h5, h6 { font-size: inherit; font-weight: inherit; }
                    a { color: inherit; text-decoration: inherit; }
                    b, strong { font-weight: bolder; }
                    img, svg, video { vertical-align: middle; display: block; }
                    button, input, select, textarea {
                        font: inherit;
                        color: inherit;
                        background-color: transparent;
                        border-radius: 0;
                    }
                }
                @layer utilities {
                    .flex { display: flex; }
                    .hidden { display: none; }
                    .inline-block { display: inline-block; }
                    .inline-flex { display: inline-flex; }
                    .flex-col { flex-direction: column; }
                    .flex-col-reverse { flex-direction: column-reverse; }
                    .items-center { align-items: center; }
                    .justify-center { justify-content: center; }
                    .justify-end { justify-content: flex-end; }
                    .gap-3 { gap: calc(var(--spacing) * 3); }
                    .gap-4 { gap: calc(var(--spacing) * 4); }
                    .min-h-screen { min-height: 100vh; }
                    .w-full { width: 100%; }
                    .max-w-\[335px\] { max-width: 335px; }
                    .max-w-\[448px\] { max-width: 448px; }
                    .max-w-4xl { max-width: 56rem; }
                    .p-6 { padding: calc(var(--spacing) * 6); }
                    .p-8 { padding: calc(var(--spacing) * 8); }
                    .px-5 { padding-inline: calc(var(--spacing) * 5); }
                    .py-1\.5 { padding-block: calc(var(--spacing) * 1.5); }
                    .py-2 { padding-block: calc(var(--spacing) * 2); }
                    .pb-12 { padding-bottom: calc(var(--spacing) * 12); }
                    .mb-1 { margin-bottom: calc(var(--spacing) * 1); }
                    .mb-2 { margin-bottom: calc(var(--spacing) * 2); }
                    .mb-4 { margin-bottom: calc(var(--spacing) * 4); }
                    .mb-6 { margin-bottom: calc(var(--spacing) * 6); }
                    .-mb-px { margin-bottom: -1px; }
                    .-ml-px { margin-left: -1px; }
                    .text-xs { font-size: var(--text-xs); line-height: calc(1 / 0.75); }
                    .text-sm { font-size: var(--text-sm); line-height: calc(1.25 / 0.875); }
                    .text-base { font-size: var(--text-base); line-height: 1.5; }
                    .text-lg { font-size: var(--text-lg); line-height: calc(1.75 / 1.125); }
                    .text-xl { font-size: var(--text-xl); line-height: calc(1.75 / 1.25); }
                    .text-2xl { font-size: var(--text-2xl); line-height: calc(2 / 1.5); }
                    .text-3xl { font-size: var(--text-3xl); line-height: 1.2; }
                    .text-4xl { font-size: var(--text-4xl); line-height: calc(2.5 / 2.25); }
                    .font-medium { font-weight: var(--font-weight-medium); }
                    .font-semibold { font-weight: var(--font-weight-semibold); }
                    .font-bold { font-weight: var(--font-weight-bold); }
                    .rounded-sm { border-radius: var(--radius-sm); }
                    .rounded-lg { border-radius: var(--radius-lg); }
                    .rounded-xl { border-radius: var(--radius-xl); }
                    .rounded-t-lg { border-top-left-radius: var(--radius-lg); border-top-right-radius: var(--radius-lg); }
                    .rounded-br-lg { border-bottom-right-radius: var(--radius-lg); }
                    .rounded-bl-lg { border-bottom-left-radius: var(--radius-lg); }
                    .border { border-style: solid; border-width: 1px; }
                    .border-b { border-bottom-style: solid; border-bottom-width: 1px; }
                    .border-black { border-color: var(--color-black); }
                    .border-\[\#e3e3e0\] { border-color: #e3e3e0; }
                    .border-\[\#19140035\] { border-color: #19140035; }
                    .border-\[\#1915014a\] { border-color: #1915014a; }
                    .bg-white { background-color: var(--color-white); }
                    .bg-black { background-color: var(--color-black); }
                    .bg-\[\#FDFDFC\] { background-color: #FDFDFC; }
                    .bg-\[\#fff2f2\] { background-color: #fff2f2; }
                    .bg-\[\#1b1b18\] { background-color: #1b1b18; }
                    .bg-\[\#f5f3ef\] { background-color: #f5f3ef; }
                    .text-white { color: var(--color-white); }
                    .text-\[\#1b1b18\] { color: #1b1b18; }
                    .text-\[\#706f6c\] { color: #706f6c; }
                    .text-\[\#f53003\] { color: #f53003; }
                    .text-\[\#2b2a27\] { color: #2b2a27; }
                    .text-\[\#8a8780\] { color: #8a8780; }
                    .underline { text-decoration-line: underline; }
                    .underline-offset-4 { text-underline-offset: 4px; }
                    .opacity-100 { opacity: 1; }
                    .shadow-sm { box-shadow: var(--shadow-sm); }
                    .shadow-md { box-shadow: var(--shadow-md); }
                    .shadow-lg { box-shadow: var(--shadow-lg); }
                    .transition-all { transition-property: all; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 0.15s; }
                    .transition-opacity { transition-property: opacity; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 0.15s; }
                    .duration-750 { transition-duration: 0.75s; }
                    .leading-normal { line-height: 1.5; }
                    .leading-\[20px\] { line-height: 20px; }
                    .shrink-0 { flex-shrink: 0; }
                    .flex-1 { flex: 1; }
                    .overflow-hidden { overflow: hidden; }
                    .relative { position: relative; }
                    .absolute { position: absolute; }
                    .inset-0 { inset: 0; }
                    .aspect-\[335\/376\] { aspect-ratio: 335/376; }
                    .not-has-\[nav\]\:hidden:not(:has(nav)) { display: none; }
                    /* custom */
                    .tracking-tight { letter-spacing: -0.025em; }
                    .bg-gradient-to-br { background-image: linear-gradient(to bottom right, var(--tw-gradient-stops)); }
                    .from-\[\#fef6f3\] { --tw-gradient-from: #fef6f3; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(254, 246, 243, 0)); }
                    .to-\[\#fce9e6\] { --tw-gradient-to: #fce9e6; }
                    .bg-clip-text { background-clip: text; -webkit-background-clip: text; }
                    .text-transparent { color: transparent; }
                    .bg-gradient-to-r { background-image: linear-gradient(to right, var(--tw-gradient-stops)); }
                    .from-\[\#1b1b18\] { --tw-gradient-from: #1b1b18; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(27, 27, 24, 0)); }
                    .to-\[\#3a3835\] { --tw-gradient-to: #3a3835; }
                    .rounded-full { border-radius: 9999px; }
                    .shadow-\[inset_0px_0px_0px_1px_rgba\(26\,26\,0\,0\.16\)\] { box-shadow: inset 0px 0px 0px 1px rgba(26, 26, 0, 0.16); }
                    .before\:absolute:before { content: var(--tw-content); position: absolute; }
                    .before\:border-l:before { content: var(--tw-content); border-left-style: solid; border-left-width: 1px; }
                    .before\:border-\[\#e3e3e0\]:before { content: var(--tw-content); border-color: #e3e3e0; }
                    .before\:top-1\/2:before { content: var(--tw-content); top: 50%; }
                    .before\:bottom-0:before { content: var(--tw-content); bottom: 0; }
                    .before\:left-\[0\.4rem\]:before { content: var(--tw-content); left: 0.4rem; }
                }
                @media (width >= 64rem) {
                    .lg\:p-8 { padding: calc(var(--spacing) * 8); }
                    .lg\:p-20 { padding: calc(var(--spacing) * 20); }
                    .lg\:max-w-4xl { max-width: 56rem; }
                    .lg\:flex-row { flex-direction: row; }
                    .lg\:justify-center { justify-content: center; }
                    .lg\:grow { flex-grow: 1; }
                    .lg\:w-\[438px\] { width: 438px; }
                    .lg\:aspect-auto { aspect-ratio: auto; }
                    .lg\:rounded-t-none { border-top-left-radius: 0; border-top-right-radius: 0; }
                    .lg\:rounded-r-lg { border-top-right-radius: var(--radius-lg); border-bottom-right-radius: var(--radius-lg); }
                    .lg\:rounded-tl-lg { border-top-left-radius: var(--radius-lg); }
                    .lg\:rounded-br-none { border-bottom-right-radius: 0; }
                    .lg\:mb-0 { margin-bottom: 0; }
                    .lg\:-ml-px { margin-left: -1px; }
                    .lg\:block { display: block; }
                    .lg\:hidden { display: none; }
                }
                /* dark mode simplified */
                @media (prefers-color-scheme: dark) {
                    .dark\:bg-\[\#0a0a0a\] { background-color: #0a0a0a; }
                    .dark\:bg-\[\#161615\] { background-color: #161615; }
                    .dark\:bg-\[\#1D0002\] { background-color: #1D0002; }
                    .dark\:text-\[\#EDEDEC\] { color: #EDEDEC; }
                    .dark\:text-\[\#A1A09A\] { color: #A1A09A; }
                    .dark\:border-\[\#3E3E3A\] { border-color: #3E3E3A; }
                    .dark\:shadow-\[inset_0px_0px_0px_1px_\#fffaed2d\] { box-shadow: inset 0px 0px 0px 1px #fffaed2d; }
                    .dark\:bg-\[\#1C1C1A\] { background-color: #1C1C1A; }
                    .dark\:text-\[\#1C1C1A\] { color: #1C1C1A; }
                    .dark\:bg-\[\#eeeeec\] { background-color: #eeeeec; }
                    .dark\:border-\[\#eeeeec\] { border-color: #eeeeec; }
                    .dark\:hover\:bg-white:hover { background-color: white; }
                    .dark\:hover\:border-white:hover { border-color: white; }
                    .dark\:hover\:bg-\[\#eeeeec\]:hover { background-color: #eeeeec; }
                    .dark\:hover\:text-\[\#1C1C1A\]:hover { color: #1C1C1A; }
                }
                @media (hover: hover) {
                    .hover\:bg-black:hover { background-color: var(--color-black); }
                    .hover\:border-black:hover { border-color: var(--color-black); }
                    .hover\:border-\[\#19140035\]:hover { border-color: #19140035; }
                    .hover\:border-\[\#1915014a\]:hover { border-color: #1915014a; }
                }
            </style>
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <!-- Main card section (same layout, enhanced with logo, slogan, professional style) -->
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
                <!-- Left content (text, logo, slogan, CTA) -->
                <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
                    
                    <!-- Logo area (brand) -->
                    <div class="mb-4 flex items-center gap-2">
                        <!-- Simple SVG logo mark: circular clock + check mark -->
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#1b1b18] to-[#3a3835] flex items-center justify-center shadow-sm">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="10" cy="10" r="7.5" stroke="#FDFDFC" stroke-width="1.2" />
                                <path d="M10 5V10L13 12" stroke="#FDFDFC" stroke-width="1.2" stroke-linecap="round" />
                                <circle cx="14.5" cy="5.5" r="2.5" fill="#FDFDFC" stroke="#1b1b18" stroke-width="1" />
                                <path d="M14 5.5L14.5 6L15.5 4.8" stroke="#1b1b18" stroke-width="1" stroke-linecap="round" />
                            </svg>
                        </div>
                        <span class="font-bold text-xl tracking-tight bg-gradient-to-r from-[#1b1b18] to-[#3a3835] bg-clip-text text-transparent dark:from-[#EDEDEC] dark:to-[#C0BDB6]">Time Table Tracker</span>
                    </div>

                    <!-- Slogan (elevated) -->
                    <h1 class="text-3xl font-bold mb-2 leading-tight text-[#1b1b18] dark:text-white">
                        Master your time,
                        <span class="text-[#f53003] dark:text-[#FF4433]">elevate</span> your performance.
                    </h1>
                    <p class="mb-6 text-[#706f6c] dark:text-[#A1A09A] text-base">
                        Track, plan, and optimize your schedule — built for students and professionals.
                    </p>

                    <!-- Additional slogan / tagline list (original list hidden, replaced with professional mini-bullets) -->
                    <ul class="flex flex-col gap-3 mb-8 text-sm">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-[#f53003] dark:text-[#FF4433] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-[#2b2a27] dark:text-[#EDEDEC]">Smart timetable sync &amp; reminders</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-[#f53003] dark:text-[#FF4433] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-[#2b2a27] dark:text-[#EDEDEC]">Weekly overview &amp; progress analytics</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-[#f53003] dark:text-[#FF4433] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-[#2b2a27] dark:text-[#EDEDEC]">Beautiful and intuitive dashboard</span>
                        </li>
                    </ul>

                    <!-- CTA buttons (same as original but refined) -->
                    <ul class="flex gap-3 text-sm leading-normal">
                        <li class="flex items-center gap-3">
                            <a href="{{ route('login') }}" class="inline-block dark:bg-[#eeeeec] dark:border-[#eeeeec] dark:text-[#1C1C1A] dark:hover:bg-white dark:hover:border-white hover:bg-black hover:border-black px-5 py-1.5 bg-[#1b1b18] rounded-sm border border-black text-white text-sm leading-normal transition-all shadow-sm">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal transition-all">
                                    Register
                                </a>
                            @endif
                        </li>
                    </ul>

                    <!-- small stat or micro-copy -->
                    <p class="text-xs text-[#8a8780] dark:text-[#6b6a66] mt-6">Free to start · No credit card required</p>
                </div>

                <!-- Right visual panel (same structure, now with enhanced "TimeTable Tracker" branding and illustration) -->
                <div class="bg-gradient-to-br from-[#fef6f3] to-[#fce9e6] dark:bg-[#1D0002] relative lg:-ml-px -mb-px lg:mb-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg aspect-[335/376] lg:aspect-auto w-full lg:w-[438px] shrink-0 overflow-hidden flex items-center justify-center">
                    <!-- Decorative abstract timetable grid (professional) -->
                    <div class="absolute inset-0 flex flex-col p-6 opacity-30 dark:opacity-20">
                        <div class="grid grid-cols-5 gap-1 flex-1">
                            <div class="bg-[#1b1b18] rounded-sm"></div>
                            <div class="bg-[#1b1b18] rounded-sm opacity-80"></div>
                            <div class="bg-[#1b1b18] rounded-sm opacity-60"></div>
                            <div class="bg-[#1b1b18] rounded-sm opacity-40"></div>
                            <div class="bg-[#1b1b18] rounded-sm opacity-20"></div>
                            <div class="bg-[#1b1b18] rounded-sm opacity-30"></div>
                            <div class="bg-[#1b1b18] rounded-sm opacity-70"></div>
                            <div class="bg-[#f53003] rounded-sm"></div>
                            <div class="bg-[#1b1b18] rounded-sm opacity-50"></div>
                            <div class="bg-[#1b1b18] rounded-sm opacity-20"></div>
                            <div class="bg-[#1b1b18] rounded-sm opacity-40"></div>
                            <div class="bg-[#1b1b18] rounded-sm opacity-60"></div>
                            <div class="bg-[#1b1b18] rounded-sm opacity-80"></div>
                            <div class="bg-[#1b1b18] rounded-sm opacity-30"></div>
                            <div class="bg-[#1b1b18] rounded-sm opacity-10"></div>
                            <div class="bg-[#1b1b18] rounded-sm opacity-20"></div>
                            <div class="bg-[#f53003] rounded-sm opacity-60"></div>
                            <div class="bg-[#1b1b18] rounded-sm opacity-40"></div>
                            <div class="bg-[#1b1b18] rounded-sm opacity-70"></div>
                            <div class="bg-[#1b1b18] rounded-sm opacity-20"></div>
                        </div>
                    </div>
                    <!-- Central message / logo emphasis on the right panel -->
                    <div class="relative z-10 text-center px-4">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-white/80 dark:bg-[#2a2a28]/80 backdrop-blur-sm flex items-center justify-center shadow-lg border border-white/50 dark:border-[#3E3E3A]">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="20" cy="20" r="16" stroke="#1b1b18" stroke-width="2.5" />
                                <path d="M20 10V20L26 24" stroke="#1b1b18" stroke-width="2.5" stroke-linecap="round" />
                                <circle cx="29" cy="11" r="4" fill="#f53003" stroke="#FDFDFC" stroke-width="1.5" />
                                <path d="M28 11L28.8 12L30.2 9.8" stroke="#FDFDFC" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-[#1b1b18] dark:text-white tracking-tight">Time Table Tracker</p>
                        <p class="text-sm text-[#4a4742] dark:text-[#A1A09A] mt-2 max-w-[200px] mx-auto">Your day, perfectly scheduled.</p>
                    </div>
                    <!-- subtle inner border -->
                    <div class="absolute inset-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] pointer-events-none"></div>
                </div>
            </main>
        </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>