<x-app-layout>
    <div class="min-h-screen bg-[#FEF7FF] p-4 md:p-6 font-sans">
        {{-- Top Greeting --}}
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h1 class="text-[32px] font-extrabold text-[#2D1B4D] leading-none">Hi, {{ Auth::user()->name }}! ✨</h1>
                    <p class="text-gray-500 mt-2 text-[14px]">Here's your study overview for today — {{ now()->format('F d, Y • l') }}</p>
                </div>
                <div class="hidden md:flex items-center gap-2 bg-white rounded-full px-4 py-2 shadow-sm text-xs">
                    <span>🔥 3 Day Streak • 12h studied</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- LEFT BIG AREA --}}
                <div class="lg:col-span-2 space-y-6">
                    {{-- Weekly Timetable Card --}}
                    <div class="bg-white rounded-[24px] p-6 shadow-[0_8px_30px_rgba(0,0,0,0.04)] border border-gray-100">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="font-bold text-[20px] text-[#2D1B4D] flex items-center gap-2 ">📅 Weekly Timetable</h2>
                            <span class="bg-[#F3E8FF] text-[#7C3AED] px-4 py-1.5 rounded-full text-xs font-semibold">This Week • {{ now()->format('M d-') }}{{ now()->addDays(6)->format('d') }}</span>
                        </div>

                        {{-- Simple Beautiful Schedule --}}
                        <div class="space-y-3">
                            <div class="grid grid-cols-12 text-[11px] text-gray-400 font-bold uppercase">
                                <div class="col-span-2">Time</div>
                                <div class="col-span-10 grid grid-cols-5 gap-2">
                                    <span class="bg-[#E9D5FF] text-center rounded-full py-1 text-[#2D1B4D]">Mon</span>
                                    <span class="bg-[#FECDD3] text-center rounded-full py-1 text-[#2D1B4D]">Tue</span>
                                    <span class="bg-[#E9D5FF] text-center rounded-full py-1">Wed</span>
                                    <span class="bg-[#FECDD3] text-center rounded-full py-1">Thu</span>
                                    <span class="bg-[#E9D5FF] text-center rounded-full py-1">Fri</span>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 bg-[#FFF1F2] border-l-4 border-[#FB7185] p-4 rounded-xl">
                                <span class="text-xs text-gray-500 w-16">09:00</span>
                                <div class="flex-1"><p class="font-bold text-sm">Math - Algebra</p><p class="text-xs text-gray-500">Room 101 • Mrs. Sharma</p></div>
                                <span class="bg-white text-[#FB7185] text-[10px] font-bold px-3 py-1 rounded-full">Live now</span>
                            </div>
                            <div class="flex items-center gap-2 bg-[#F5F3FF] border-l-4 border-[#A78BFA] p-4 rounded-xl">
                                <span class="text-xs text-gray-500 w-16">11:00</span>
                                <div class="flex-1"><p class="font-bold text-sm">Science - Physics</p><p class="text-xs text-gray-500">Lab 3 • Mr. Verma</p></div>
                                <span class="bg-[#EDE9FE] text-[#7C3AED] text-[10px] font-bold px-3 py-1 rounded-full">Upcoming • 11:00</span>
                            </div>
                            <div class="flex items-center gap-2 bg-[#FFFBEB] border-l-4 border-[#FBBF24] p-4 rounded-xl">
                                <span class="text-xs text-gray-500 w-16">14:00</span>
                                <div class="flex-1"><p class="font-bold text-sm">English - Literature</p><p class="text-xs text-gray-500">Ms. Carter</p></div>
                                <span class="bg-white text-gray-600 text-[10px] px-3 py-1 rounded-full">Upcoming • 14:00</span>
                            </div>
                        </div>
                    </div>

                    {{-- Study Progress --}}
                    <div class="bg-white rounded-[24px] p-6 shadow-sm">
                        <h3 class="font-bold text-[#2D1B4D] mb-4">📈 Study Progress</h3>
                        <div class="grid grid-cols-3 md:grid-cols-6 gap-4">
                            <div><p class="text-xs font-bold">Math</p><div class="h-2 bg-gray-100 rounded-full mt-2"><div class="h-2 bg-[#FB9CB0] rounded-full" style="width:85%"></div></div><p class="text-[11px] mt-1">85%</p></div>
                            <div><p class="text-xs font-bold">Science</p><div class="h-2 bg-gray-100 rounded-full mt-2"><div class="h-2 bg-[#C4B5FD] rounded-full" style="width:70%"></div></div><p class="text-[11px] mt-1">70%</p></div>
                            <div><p class="text-xs font-bold">English</p><div class="h-2 bg-gray-100 rounded-full mt-2"><div class="h-2 bg-[#FECDD3] rounded-full" style="width:92%"></div></div><p class="text-[11px] mt-1">92%</p></div>
                        </div>
                        <div class="mt-6 bg-[#FFF1F2] p-3 rounded-full flex justify-between items-center text-xs">
                            <span>Weekly goal: 20h</span><span>16.5h / 20h — 83% completed — great job! 🎯</span>
                        </div>
                    </div>
                </div>

                {{-- RIGHT SIDE --}}
                <div class="space-y-6">
                    <div class="bg-white rounded-[24px] p-6 shadow-sm">
                        <h3 class="font-bold text-[#2D1B4D]">Homework & Tasks <span class="float-right text-[#7C3AED] text-xs font-normal">5/7 completed</span></h3>
                        <div class="mt-4 space-y-3 text-sm">
                            <div class="flex justify-between items-center"><span>✅ Math: Worksheet p. 24 <br><small class="text-green-600">Completed</small></span><span class="text-[10px] bg-[#FFE4E6] px-2 py-1 rounded-full">Due Today</span></div>
                            <div class="flex justify-between items-center"><span>🔘 Science: Lab Report<br><small class="text-green-600">Completed</small></span><span class="text-[10px] bg-[#FFE4E6] px-2 py-1 rounded-full">Due Today</span></div>
                            <div class="flex justify-between items-center"><span>📝 English: Essay Draft<br><small class="text-gray-500">Not done yet</small></span><span class="text-[10px] bg-[#EDE9FE] px-2 py-1 rounded-full">Due Tomorrow</span></div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[24px] p-6 shadow-sm text-center">
                        <h3 class="font-bold text-left">Overall Progress</h3>
                        <div class="my-4 w-24 h-24 mx-auto rounded-full border-[6px] border-[#E9D5FF] border-t-[#FB7185] flex items-center justify-center font-bold text-xl">72%</div>
                        <p class="text-xs text-gray-500">Study Goal Progress</p>
                        <div class="grid grid-cols-3 gap-2 mt-4 text-[11px]">
                            <div class="bg-gray-50 p-2 rounded-xl">✨<br><b>Streak</b><br>7 days 🔥</div>
                            <div class="bg-gray-50 p-2 rounded-xl">🏆<br><b>Points</b><br>1,240 pts</div>
                            <div class="bg-gray-50 p-2 rounded-xl">⭐<br><b>Badges</b><br>4 earned</div>
                        </div>
                        <button class="mt-6 w-full bg-[#2D1B4D] text-white py-3 rounded-full text-sm font-bold">+ Add New Task</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>