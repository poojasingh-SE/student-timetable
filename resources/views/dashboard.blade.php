<x-app-layout>

    <div class="flex min-h-screen w-full bg-slate-50">
            <!-- Mobile Menu Overlay -->
    <div x-show="mobileMenuOpen" class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden" @click="mobileMenuOpen = false"></div>
    <aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full'" 
           class="fixed inset-y-0 left-0 z-50 w-64 bg-white transition-transform duration-300 lg:static lg:translate-x-0 flex flex-col border-r border-slate-100 shadow-sm m-4 rounded-3xl">
        
        <!-- Logo -->
        <div class="h-24 flex items-center px-8 gap-3">
            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white">
                <i class="fa-solid fa-book-open text-xl"></i>
            </div>
            <div>
                <h1 class="font-bold text-xl leading-tight text-slate-900">Time Table Tracker</h1>
                <p class="text-xs text-slate-500 font-medium">Student Portal</p>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 py-4 space-y-2">

            <a href="#dashboard"
                class="flex items-center gap-4 px-4 py-3 bg-blue-50 text-blue-600 rounded-xl font-medium transition-colors">
                <i class="fa-solid fa-graduation-cap w-5 text-center"></i>
                Dashboard
            </a>

            <a href="#timetable"
                class="flex items-center gap-4 px-4 py-3 text-slate-500 hover:bg-slate-50 rounded-xl font-medium transition-colors">
                <i class="fa-solid fa-table-list w-5 text-center"></i>
                Timetable
            </a>

            <a href="#homework"
                class="flex items-center gap-4 px-4 py-3 text-slate-500 hover:bg-slate-50 rounded-xl font-medium transition-colors">
                <i class="fa-regular fa-clipboard w-5 text-center"></i>
                Homework
            </a>

            <a href="#progress"
                class="flex items-center gap-4 px-4 py-3 text-slate-500 hover:bg-slate-50 rounded-xl font-medium transition-colors">
                <i class="fa-solid fa-chart-simple w-5 text-center"></i>
                Progress
            </a>

        </nav>

        <!-- User Profile / Logout -->
        <div class="p-6 border-t border-slate-100">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                    {{ Str::upper(Str::substr(Auth::user()->name,0,1) . Str::substr(Str::after(Auth::user()->name, ''),0,1))}}
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-slate-900 truncate">{{ Auth::user()->name }} </p>
                    <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <button class="flex items-center gap-3 text-slate-500 hover:text-slate-800 text-sm font-medium transition-colors">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                               <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                 
            </button>
        </div>
    </aside>
         

        {{-- Dashboard Main Content --}}
        <div id="dashboard" class="flex-1 min-w-0 w-full">
          <!-- Mobile Header -->
            <div class="lg:hidden flex items-center justify-between p-4 bg-white m-4 rounded-2xl shadow-sm">
            <h1 class="font-bold text-lg">Time Table Tracker</h1>
            <button @click="mobileMenuOpen = true" class="p-2 text-slate-600">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
        </div>

        <!-- Scrollable Content Area -->
        <div class="flex-1 overflow-y-auto custom-scroll p-4 lg:p-8">
            
            <!-- Header Area -->
            <header class="flex flex-col xl:flex-row xl:items-center justify-between mb-8 gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold text-blue-950 tracking-tight">Hi , {{ucfirst(Auth::user()->name) }}</h2>
                    <p class="text-slate-500 mt-1 font-medium">Track your weekly classes, tasks & progress</p>
                </div>
            </header>

            <!-- Top Stats Row -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <!-- Total Classes -->
                <div class="bg-white rounded-2xl p-5 flex items-center gap-5 shadow-sm border border-slate-100">
                    <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center text-xl">
                        <i class="fa-regular fa-calendar-days"></i>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Total Classes</p>
                        <h3 class="text-2xl font-bold text-slate-900">{{ $totalClasses }}</h3>
                        <p class="text-xs text-green-500 font-medium mt-0.5"><i class="fa-solid fa-arrow-up text-[10px]"></i>     Scheduled this week
                        </p>
                    </div>
                </div>
                <!-- Today's Classes -->
                <div class="bg-[#ecfdf5] rounded-2xl p-5 flex items-center gap-5 shadow-sm border border-emerald-100">
                    <div class="w-12 h-12 bg-white text-emerald-500 rounded-xl flex items-center justify-center text-xl shadow-sm">
                        <i class="fa-regular fa-circle-check"></i>
                    </div>
                    <div>
                        <p class="text-sm text-emerald-700 font-medium">Today's Classes</p>
                        <h3 class="text-2xl font-bold text-slate-900">{{ $todayClasses }}</h3>
                        <p class="text-xs text-emerald-600 font-medium mt-0.5">    Scheduled for today</p>
                    </div>
                </div>
                <!-- Study Hours This Week -->
                <div class="bg-[#fff7ed] rounded-2xl p-5 flex items-center gap-5 shadow-sm border border-orange-100">
                    <div class="w-12 h-12 bg-white text-orange-500 rounded-xl flex items-center justify-center text-xl shadow-sm">
                        <i class="fa-solid fa-fire"></i>
                    </div>
                    <div>
                        <p class="text-sm text-orange-800 font-medium">Study Hours This Week</p>
                        <h3 class="text-2xl font-bold text-slate-900">{{ $studyHours }} hrs</h3>
                        <p class="text-xs text-orange-600 font-medium mt-0.5">    Based on calendar events</p>
                    </div>
                </div>
            </div>

            <!-- Google Calendar Events -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 mb-6">

                 <h3 class="text-xl font-bold text-slate-900 mb-4">
                Today's Google Calendar Events
                 </h3>
                 @if(!$isCalendarConnected)

                    <div class="text-center py-6">
                        <p class="text-sm text-slate-500 mb-4">
                            Connect your Google Calendar to view your timetable and events.
                        </p>

                        <a href="{{ route('google.link') }}"
                        class="inline-flex items-center px-5 py-2.5
                                bg-blue-600 text-white text-sm font-semibold
                                rounded-xl hover:bg-blue-700 transition">
                            Connect Google Calendar
                        </a>
                    </div>

                @else
                @forelse($events as $event)

                    @php
                        $isTimedEvent = isset($event['start']['dateTime'])
                            && isset($event['end']['dateTime']);

                        $isCompleted = $isTimedEvent
                            && in_array($event['id'], $completedEventIds);
                    @endphp

                    <div class="flex items-center justify-between p-4 mb-3 bg-blue-50 rounded-xl">

                        <div>
                            <h4 class="font-semibold text-slate-900">
                                {{ $event['summary'] ?? 'Untitled Event' }}
                            </h4>

                            @if($isTimedEvent)
                                <p class="text-sm text-slate-500">
                                    {{ \Carbon\Carbon::parse($event['start']['dateTime'])->setTimezone('Asia/Kolkata')->format('h:i A') }}
                                    -
                                    {{ \Carbon\Carbon::parse($event['end']['dateTime'])->setTimezone('Asia/Kolkata')->format('h:i A') }}
                                </p>
                            @else
                                <p class="text-sm text-slate-500">All day</p>
                            @endif
                        </div>

                        @if($isTimedEvent)

                            <form method="POST"
                                action="{{ route('classes.complete', $event['id']) }}">

                                @csrf

                                <button type="submit"
                                    class="text-xs font-semibold px-3 py-2 rounded-full
                                    {{ $isCompleted
                                        ? 'text-green-700 bg-green-100'
                                        : 'text-blue-700 bg-blue-100 hover:bg-blue-200' }}">

                                    {{ $isCompleted ? 'Completed ✓' : 'Mark as Completed' }}

                                </button>

                            </form>

                        @else

                            <span class="text-xs font-semibold text-blue-700 bg-blue-100 px-3 py-1 rounded-full">
                                All Day Event
                            </span>

                        @endif

                    </div>

                    @empty

                    <p class="text-sm text-slate-500">
                        No Google Calendar events scheduled for today.
                    </p>

                @endforelse
                @endif
                </div>


                <!-- Main Content Grid (Timetable & Right Sidebar) -->
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                    
                    <!-- ================= WEEKLY TIMETABLE (Left 2 cols) ================= -->
                    <div id="timetable" class="xl:col-span-2 bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex flex-col">
                        <h3 class="text-xl font-bold text-slate-900 mb-1">Weekly Timetable</h3>
                        @if(!$isCalendarConnected)

                            <div class="text-center py-10">
                                <p class="text-sm text-slate-500 mb-4">
                                Connect Google Calendar using the button above
                                to view your weekly timetable.

                                </p>
                            </div>

                        @else

                            @if(empty($weeklyEvents))
                                <p class="text-sm text-slate-500 py-3">
                                    No events scheduled for this week.
                                </p>
                            @endif

                        <!-- Timetable Grid Container -->
                        <div class="overflow-x-auto custom-scroll flex-1">
                            <div class="min-w-[700px]">
                                <!-- Days Header -->

                                <div class="grid grid-cols-[60px_repeat(7,1fr)] gap-2 mb-2 text-center text-sm font-semibold text-slate-600">
                                    <div class="text-left text-xs text-slate-400 pt-2 font-medium"></div>

                                    @foreach ($weekDays as $day)
                                        <div class="py-2">
                                            <span>{{ strtoupper($day->format('D')) }}</span>
                                            <span class="block text-xs text-slate-400">
                                                {{ $day->format('d') }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>

                                
                                <!-- Weekly Calendar Grid -->
                                <div
                                    class="grid gap-0"
                                    style="
                                        grid-template-columns: 60px repeat(7, minmax(90px, 1fr));
                                        grid-template-rows: repeat(34, 48px);">
                                    <!-- Time Labels and Empty Calendar Cells -->
                                    @foreach ($timeSlots as $slot)
                                        <div
                                            class="text-[10px] text-slate-500 font-semibold flex items-center"
                                            style="grid-column: 1; grid-row: {{ $loop->iteration }};">
                                            {{ \Carbon\Carbon::createFromTime(
                                                intdiv($slot, 2),
                                                ($slot % 2) * 30
                                            )->format('h:i A') }}
                                        </div>

                                        @foreach ($weekDays as $day)
                                            <div
                                                class="border-b border-l border-slate-100"
                                                style="
                                                    grid-column: {{ $loop->iteration + 1 }};
                                                    grid-row: {{ $loop->parent->iteration }};
                                                "
                                            ></div>
                                        @endforeach
                                    @endforeach

                                    <!-- Google Calendar Events -->
                                    @foreach ($weekDays as $dayIndex => $day)
                                        @foreach ($weeklyEventsBySlot[$day->toDateString()] ?? [] as $item)
                                            <div
                                                class="bg-blue-600 text-white rounded-lg p-2 mx-1
                                                    shadow-sm overflow-hidden flex flex-col gap-1
                                                    min-h-0 z-10 leading-tight"
                                                    style="
                                                        grid-column: {{ $dayIndex + 2 }};
                                                        grid-row: {{ $item['start_slot'] - 11 }} / span {{ $item['grid_span'] }};
                                                        align-self: start;
                                                        margin-top: {{ $item['start_offset'] * 1.6 }}px;
                                                        height: {{ $item['duration_minutes'] * 1.6 }}px;
                                                        box-sizing: border-box;
                                                    "
                                            >
                                                <span class="text-[10px] leading-tight">
                                                    {{ $item['event']['summary'] ?? 'Untitled Event' }}
                                                </span>

                                                <span class="text-[10px]">
                                                    {{ \Carbon\Carbon::parse(
                                                        $item['event']['start']['dateTime']
                                                    )->timezone('Asia/Kolkata')->format('h:i A') }}
                                                    -
                                                    {{ \Carbon\Carbon::parse(
                                                        $item['event']['end']['dateTime']
                                                    )->timezone('Asia/Kolkata')->format('h:i A') }}
                                                </span>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>


                            </div>
                        </div>
                        @endif
                    </div>


                    <!-- ================= RIGHT SIDEBAR ================= -->
                    <div class="flex flex-col gap-6">
                        
                        <!-- Today's Progress -->
                        <div id="progress" class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex flex-col items-center text-center">
                            <h3 class="text-lg font-bold text-slate-900 w-full text-left mb-4">Today's Progress</h3>
                            
                            <!-- Circular Progress Bar -->
                            <div class="relative w-40 h-40 mb-4">
                                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                                    <circle class="text-slate-100 stroke-current" stroke-width="12" cx="50" cy="50" r="40" fill="transparent"></circle>
                                    <circle class="text-blue-600 stroke-current" stroke-width="12" stroke-linecap="round" cx="50" cy="50" r="40" fill="transparent" stroke-dasharray="251.2" stroke-dashoffset="{{ 251.2 - (251.2 * $progressPercentage / 100) }}"></circle>
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center flex-col">
                                    <span class="text-3xl font-extrabold text-blue-900">{{$progressPercentage }}%</span>
                                </div>
                            </div>
                            <p class="text-sm text-slate-500 font-medium">
                                Completed {{ $completedClasses }} / {{ $totalTodayClasses }} classes
                            </p>
                        </div>

                        {{-- Success Message --}}
                        @if(session('success'))
                            <div class="mb-4 p-3 rounded-lg bg-emerald-100 text-emerald-700 text-sm">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Validation Errors --}}
                        @if($errors->any())
                            <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 text-sm">
                                <ul class="list-disc pl-5">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Upcoming Tasks -->
                        <div id="homework" class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">

                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-slate-900">Upcoming Tasks</h3>
                                <button
                                    type="button"
                                    onclick="document.getElementById('homeworkModal').classList.remove('hidden')"
                                    class="text-sm text-blue-600 font-semibold hover:text-blue-700">
                                    + Add
                                </button>
                            </div>

                            <div class="space-y-5">

                                @forelse($homeworkTasks as $task)
                                
                                @php
                                    $isCompleted = !is_null($task->completed_at);

                                    $isOverdue = !$isCompleted && $task->due_at->isPast();
                                @endphp

                                    <div class="flex items-start gap-3">

                                        
                                        <div class="mt-1">
                                                <input
                                                    type="checkbox"
                                                    class="homework-checkbox w-4 h-4 rounded border-slate-300 text-blue-600 cursor-pointer"
                                                    data-url="{{ route('homework.toggleComplete', $task->id) }}"
                                                    data-task-id="{{ $task->id }}"
                                                    @checked($isCompleted)
                                                >
                                            </div>
                                        

                                        <div class="flex-1">
                                        <button
                                            type="button"
                                            onclick="openEditHomework(
                                                {{ $task->id }},
                                                @js($task->title),
                                                @js($task->subject),
                                                @js($task->description),
                                                '{{ $task->due_at->format('Y-m-d') }}',
                                                '{{ $task->due_at->format('H:i') }}'
                                            )"
                                            class="text-xs text-blue-600 font-semibold hover:text-blue-700">
                                            Edit
                                        </button>

                                        <form
                                                action="{{ route('homework.destroy', $task->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this homework?')"
                                                class="inline-block ml-2"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="text-xs text-red-600 font-semibold hover:text-red-700"
                                                >
                                                    Delete
                                                </button>
                                            </form>

                                            <p class="text-sm font-semibold text-slate-800 leading-tight">
                                                {{ $task->title }}
                                            </p>

                                            <div class="flex items-center flex-wrap gap-2 mt-1.5">

                                                <span class="text-xs text-slate-500 font-medium">
                                                    {{ $task->subject }}
                                                </span>

                                                <span class="text-xs text-slate-500 font-medium">
                                                    Due {{ $task->due_at->isToday()
                                                        ? 'today'
                                                        : ($task->due_at->isTomorrow()
                                                            ? 'tomorrow'
                                                            : $task->due_at->format('d M'))
                                                    }}
                                                    • {{ $task->due_at->format('h:i A') }}
                                                </span>

                                                @if($isCompleted)
                                                    <span
                                                        data-status-id="{{ $task->id }}"
                                                        class="homework-status text-[10px] bg-emerald-100 text-emerald-600 px-2 py-0.5 rounded-full font-bold">
                                                        Completed
                                                    </span>

                                                @elseif($isOverdue)
                                                    <span
                                                        data-status-id="{{ $task->id }}"
                                                        class="homework-status text-[10px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold">
                                                        Overdue
                                                    </span>

                                                @else
                                                    <span
                                                        data-status-id="{{ $task->id }}"
                                                        class="homework-status text-[10px] bg-orange-100 text-orange-600 px-2 py-0.5 rounded-full font-bold">
                                                        Pending
                                                    </span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>

                                @empty

                                    <p class="text-sm text-slate-500 text-center py-4">
                                        No homework tasks added yet.
                                    </p>

                                @endforelse

                            </div>
                        </div>

                    </div>
                </div>
        </div>

        </div>

    </div>
    <!-- Add Homework Modal -->
<div
    id="homeworkModal"
    class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
>
    <div class="bg-white rounded-2xl w-full max-w-lg p-6 shadow-xl">

        <!-- Modal Header -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-slate-900">
                Add Homework
            </h2>

            <button
                type="button"
                onclick="document.getElementById('homeworkModal').classList.add('hidden')"
                class="text-slate-400 hover:text-slate-700 text-xl"
            >
                &times;
            </button>
        </div>

        <!-- Homework Form -->
        <form action="{{ route('homework.store') }}" method="POST">
            @csrf

            <div class="space-y-4">

                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Homework Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        required
                        maxlength="255"
                        placeholder="Enter homework title"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <!-- Subject -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Subject
                    </label>

                    <select
                        name="subject"
                        required
                        class="w-full rounded-lg border border-slate-300 px-3 py-2"
                    >
                        <option value="">Select Subject</option>
                        <option value="Maths">Maths</option>
                        <option value="Physics">Physics</option>
                        <option value="Chemistry">Chemistry</option>
                        <option value="English">English</option>
                        <option value="Hindi">Hindi</option>
                        <option value="Computer Science">Computer Science</option>
                    </select>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Description (Optional)
                    </label>

                    <textarea
                        name="description"
                        rows="3"
                        placeholder="Enter additional details"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2"
                    ></textarea>
                </div>

                <!-- Due Date and Time -->
                <div class="grid grid-cols-2 gap-3">

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Due Date
                        </label>

                        <input
                            type="date"
                            name="due_date"
                            required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Due Time
                        </label>

                        <input
                            type="time"
                            name="due_time"
                            required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2"
                        >
                    </div>

                </div>

            </div>

            <!-- Footer -->
            <div class="flex justify-end gap-3 mt-6">

                <button
                    type="button"
                    onclick="document.getElementById('homeworkModal').classList.add('hidden')"
                    class="px-4 py-2 text-sm font-semibold text-slate-600"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700"
                >
                    Save Homework
                </button>

            </div>

        </form>

    </div>
</div>

<!-- Edit Homework Modal -->
<div id="editHomeworkModal"
    class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4">

    <div class="bg-white rounded-2xl p-6 w-full max-w-md">

        <div class="flex items-center justify-between mb-5">
            <h2 class="text-lg font-bold text-slate-900">
                Edit Homework
            </h2>

            <button
                type="button"
                onclick="document.getElementById('editHomeworkModal').classList.add('hidden')"
                class="text-slate-500 text-xl">
                &times;
            </button>
        </div>

        <form id="editHomeworkForm" method="POST">

            @csrf
            @method('PUT')

            <div class="space-y-4">

                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input
                        type="text"
                        name="title"
                        id="edit_title"
                        required
                        class="w-full rounded-lg border-slate-300">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Subject</label>
                    <input
                        type="text"
                        name="subject"
                        id="edit_subject"
                        required
                        class="w-full rounded-lg border-slate-300">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea
                        name="description"
                        id="edit_description"
                        class="w-full rounded-lg border-slate-300"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Due Date</label>
                    <input
                        type="date"
                        name="due_date"
                        id="edit_due_date"
                        required
                        class="w-full rounded-lg border-slate-300">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Due Time</label>
                    <input
                        type="time"
                        name="due_time"
                        id="edit_due_time"
                        required
                        class="w-full rounded-lg border-slate-300">
                </div>

            </div>

            <div class="flex justify-end gap-3 mt-6">

                <button
                    type="button"
                    onclick="document.getElementById('editHomeworkModal').classList.add('hidden')"
                    class="px-4 py-2 text-sm text-slate-600">
                    Cancel
                </button>

                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold">
                    Update Homework
                </button>

            </div>

        </form>
    </div>
</div>

<script>
    document.querySelectorAll('.homework-checkbox').forEach((checkbox) => {

        checkbox.addEventListener('change', async function () {

            const previousState = !this.checked;

            this.disabled = true;

            try {
                const response = await fetch(this.dataset.url, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await response.json();

                if (!response.ok || !data.success) {
                    throw new Error('Unable to update homework status.');
                }

                this.checked = data.completed;

                const taskId = this.dataset.taskId;

                const status = document.querySelector(
                    `[data-status-id="${taskId}"]`
                );

                if (data.completed) {

                    status.textContent = 'Completed';

                    status.className =
                        'homework-status text-[10px] bg-emerald-100 text-emerald-600 px-2 py-0.5 rounded-full font-bold';

                } else if (data.overdue) {

                    status.textContent = 'Overdue';

                    status.className =
                        'homework-status text-[10px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold';

                } else {

                    status.textContent = 'Pending';

                    status.className =
                        'homework-status text-[10px] bg-orange-100 text-orange-600 px-2 py-0.5 rounded-full font-bold';
                }

            } catch (error) {

                this.checked = previousState;

                alert('Homework status update failed. Please try again.');

                console.error(error);

            } finally {
                this.disabled = false;
            }

        });

    });

    function openEditHomework(id, title, subject, description, dueDate, dueTime) {

        // Set form action URL
        const form = document.getElementById('editHomeworkForm');

        form.action = `/homework/${id}`;

        // Fill existing homework data
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_subject').value = subject;
        document.getElementById('edit_description').value = description ?? '';
        document.getElementById('edit_due_date').value = dueDate;
        document.getElementById('edit_due_time').value = dueTime;

        // Open modal
        document.getElementById('editHomeworkModal').classList.remove('hidden');
        }
</script>

</x-app-layout>