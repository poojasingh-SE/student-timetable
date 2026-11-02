<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleCalendarService;
use Illuminate\View\View;
use Carbon\Carbon;
use App\Models\ClassCompletion;
use App\Models\HomeworkTask;


class DashboardController extends Controller
{
    public function index(
        GoogleCalendarService $calendarService
    ): View 
    {
        $weeklyEvents = $calendarService->getWeeklyEvents(
            auth()->user()
        );


        // Prepare Monday to Sunday
        $weekStart = now('Asia/Kolkata')
            ->startOfWeek(Carbon::MONDAY);
    

        $weekDays = collect(range(0, 6))->map(
           fn ($day) => $weekStart->copy()->addDays($day)
        );

        // Prepare 24 hours (12 AM to 11 PM)
        // $timeSlots = range(0, 23);
        $startHour = 6;
        $endHour = 23;

        $timeSlots = collect(range(
            $startHour * 2,
            ($endHour * 2) - 1
        ));
        
    
        $today = now('Asia/Kolkata')->toDateString();
        
    
        $events = array_values(array_filter(
            $weeklyEvents,
            function ($event) use ($today) {
                if (isset($event['start']['date'])) {
                    return $event['start']['date'] === $today;
                }
    
                if (isset($event['start']['dateTime'])) {
                    return \Carbon\Carbon::parse(
                        $event['start']['dateTime']
                    )->timezone('Asia/Kolkata')->toDateString() === $today;
                }
    
                return false;
            }
        ));


        // $weeklyEventsBySlot = [];

        // foreach ($weeklyEvents as $event) {

        //     if (!isset($event['start']['dateTime'])) {
        //         continue;
        //     }

        //     $startTime = Carbon::parse($event['start']['dateTime'])
        //         ->timezone('Asia/Kolkata');

        //     $date = $startTime->toDateString();
        //     $hour = $startTime->hour;

        //     $weeklyEventsBySlot[$date][$hour][] = $event;
        // }

        $weeklyEventsBySlot = [];

        foreach ($weeklyEvents as $event) {

            // All-day events ko abhi hourly grid se skip karenge
            if (
                !isset($event['start']['dateTime']) ||
                !isset($event['end']['dateTime'])
            ) {
                continue;
            }

            $startTime = Carbon::parse($event['start']['dateTime'])
                ->timezone('Asia/Kolkata');

            $endTime = Carbon::parse($event['end']['dateTime'])
                ->timezone('Asia/Kolkata');

            $date = $startTime->toDateString();

            // Starting position: 30-minute slots
            $startSlot = ($startTime->hour * 2)
                + ($startTime->minute >= 30 ? 1 : 0);

            // Event duration in minutes
            $durationMinutes = $startTime->diffInMinutes($endTime);

            // Number of 30-minute slots occupied
            $slotDuration = (int) ceil($durationMinutes / 30);

            $weeklyEventsBySlot[$date][] = [
                'event' => $event,
                'start_slot' => $startSlot,
                'duration' => $slotDuration,
            ];
        }

        // Dashboard Statistics

        $totalClasses = count($weeklyEvents);

        $todayClasses = count($events);

        $totalStudyMinutes = 0;

        foreach ($weeklyEvents as $event) {

            if (
                !isset($event['start']['dateTime']) ||
                !isset($event['end']['dateTime'])
            ) {
                continue;
            }

            $startTime = Carbon::parse($event['start']['dateTime']);
            $endTime = Carbon::parse($event['end']['dateTime']);

            $totalStudyMinutes += $startTime->diffInMinutes($endTime);
        }

        $studyHours = round($totalStudyMinutes / 60, 1);

                // Get today's timed classes only
        $todayTimedEvents = array_values(array_filter(
            $events,
            function ($event) {
                return isset($event['start']['dateTime'])
                    && isset($event['end']['dateTime']);
            }
        ));

        // Get today's event IDs
        $todayEventIds = array_column($todayTimedEvents, 'id');

        // Fetch completed classes for the logged-in user
        $completedEventIds = ClassCompletion::where('user_id', auth()->id())
            ->whereIn('google_event_id', $todayEventIds)
            ->pluck('google_event_id')
            ->toArray();

        // Calculate today's progress
        $totalTodayClasses = count($todayTimedEvents);

        $completedClasses = count($completedEventIds);

        $progressPercentage = $totalTodayClasses > 0
            ? round(($completedClasses / $totalTodayClasses) * 100)
            : 0;

            // Fetch upcoming homework tasks for logged-in user
            $homeworkTasks = HomeworkTask::where('user_id', auth()->id())
                    ->orderByRaw(
                        'CASE
                            WHEN completed_at IS NULL AND due_at < ? THEN 0
                            WHEN completed_at IS NULL THEN 1
                            ELSE 2
                        END',
                        [now('Asia/Kolkata')->toDateTimeString()]
                    )
                    ->orderBy('due_at', 'asc')
                    ->take(5)
                    ->get();    
        return view(
            'dashboard',
            compact('events', 'weeklyEvents', 'weekDays', 'timeSlots','weeklyEventsBySlot','totalClasses',
            'todayClasses',
            'studyHours','todayTimedEvents',
            'completedEventIds',
            'totalTodayClasses',
            'completedClasses',
            'progressPercentage','homeworkTasks')
        );
    }
}
