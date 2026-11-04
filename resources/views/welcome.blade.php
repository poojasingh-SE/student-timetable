<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trim($__env->yieldContent('title', config('app.name'))) }}</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body{font-family: 'Inter', sans-serif} </style>
</head>
<body class="bg-indigo-500  text-[#1b1b18] min-h-screen overflow-hidden">
    <!-- Navbar -->
    <nav class="flex justify-between items-center px-6 md:px-16 py-6 max-w-7xl mx-auto">
        <div class="flex items-center gap-2 font-bold text-[17px]">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center">
            <img src="{{ asset('images/logo.svg') }}" alt="Student Timetable Tracker">
            
            </div>

                <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-900">
                {{trim($__env->yieldContent('title', config('app.name')))}}
                </h1>
            </div>
        </div>
        <div class="flex items-center gap-3 text-white">
            <a href="{{ route('login') }}" class="px-6 py-2.5 text-sm font-medium hover:bg-black/5 rounded-full transition">Log in</a>
            <a href="{{ route('register') }}" class="px-6 py-2.5 bg-black text-sm font-medium rounded-full hover:bg-zinc-800 transition">Register</a>
        </div>
    </nav>

    <!-- Main -->
    <div class="max-w-7xl mx-auto px-6 md:px-16 mt-8 md:mt-16 grid md:grid-cols-2 gap-10 md:gap-20 items-center">
        <!-- Left -->
        <div>
            <span class="inline-block text-[11px] font-bold tracking-widest bg-white border px-3 py-1.5 rounded-full mb-5">

                    Plan • Study • Achieve
            </span>
            <h1 class="text-[40px] md:text-[52px] font-bold leading-[0.95] tracking-tight">
                Master your task,<br>elevate your<br><span class="text-zinc-400">performance.</span></h1>
            <p class="text-white mt-5 mb-7 text-whiteleading-relaxed text-[15px] max-w-[420px] ">Track, plan, and optimize your schedule — built for students and professionals. Smart timetable sync & reminders.</p>
            
            <div class="space-y-3.5 mb-9 text-white">
                <div class="flex items-center gap-3 text-[14px]"><span class="w-6 h-6 bg-white border rounded-full flex items-center justify-center text-[11px]">✓</span> Smart timetable sync & reminders</div>
                <div class="flex items-center gap-3 text-[14px]"><span class="w-6 h-6 bg-white border rounded-full flex items-center justify-center text-[11px]">✓</span> Weekly overview & progress analytics</div>
                <div class="flex items-center gap-3 text-[14px]"><span class="w-6 h-6 bg-white border rounded-full flex items-center justify-center text-[11px]">✓</span> Beautiful and intuitive dashboard</div>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('login') }}" class="px-7 py-3.5 bg-black text-white rounded-full text-sm font-semibold hover:bg-zinc-800">Get Started →</a>
                <a href="{{ route('register') }}" class="px-7 py-3.5 bg-white border rounded-full text-sm font-semibold hover:bg-zinc-50">Create Account</a>
            </div>
            <p class="text-[11px] text-white mt-4">Free to start • No credit card required</p>
        </div>

        <!-- Right Card -->
        <div class="bg-white rounded-[32px] p-8 shadow-[0_24px_64px_rgba(0,0,0,0.08)] border border-black/[0.06]">
            <div class="flex justify-between items-center mb-8">
                <h3 class="font-semibold text-[15px]">Today's Schedule</h3>
                <div class="w-10 h-10 bg-[#f8f7f4] rounded-full flex items-center justify-center text-sm">🕒</div>
            </div>
            <div class="space-y-4">
                <div class="p-4 bg-[#f8f7f4] rounded-2xl flex justify-between items-center">
                    <div><p class="text-[14px] font-semibold">Data Structure</p><p class="text-[11px] text-zinc-500 mt-0.5">09:00 - 10:00 AM</p></div>
                    <span class="text-[11px] bg-green-100 text-green-700 px-2.5 py-1 rounded-full font-medium">Live</span>
                </div>
                <div class="p-4 bg-white border border-black/5 rounded-2xl flex justify-between items-center">
                    <div><p class="text-[14px] font-semibold">Project Meeting</p><p class="text-[11px] text-zinc-500 mt-0.5">11:30 - 12:30 PM</p></div>
                    <span class="text-[11px] bg-zinc-100 px-2.5 py-1 rounded-full">Upcoming</span>
                </div>
                <div class="p-4 bg-white border border-black/5 rounded-2xl flex justify-between items-center">
                    <div><p class="text-[14px] font-semibold">Study Session</p><p class="text-[11px] text-zinc-500 mt-0.5">03:00 - 04:30 PM</p></div>
                    <span class="text-[11px] bg-zinc-100 px-2.5 py-1 rounded-full">Pending</span>
                </div>
            </div>
            <div class="mt-8 text-center border-t pt-6">
                <p class="text-[13px] font-semibold">Time Table Tracker</p>
                <p class="text-[11px] text-zinc-500 mt-1">Your day, perfectly scheduled.</p>
            </div>
        </div>
    </div>
</body>
</html>