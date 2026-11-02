<?php

namespace App\Http\Controllers;

use App\Models\ClassCompletion;
use App\Services\GoogleCalendarService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class ClassCompletionController extends Controller
{
    public function store(
        Request $request,
        string $eventId,
        GoogleCalendarService $calendarService
    ): RedirectResponse {

        $user = $request->user();

        // Fetch events from the authenticated user's Google Calendar
        $weeklyEvents = $calendarService->getWeeklyEvents($user);

        // Verify that the submitted event belongs to this user's calendar
        $event = collect($weeklyEvents)->firstWhere('id', $eventId);

        if (!$event) {
            abort(404, 'Calendar event not found.');
        }

        // Prevent all-day events from being marked as completed
        if (
            !isset($event['start']['dateTime']) ||
            !isset($event['end']['dateTime'])
        ) {
            abort(422, 'All-day events cannot be marked as completed.');
        }

        $completion = ClassCompletion::where(
            'user_id',
            $user->id
        )->where(
            'google_event_id',
            $eventId
        )->first();
        
        if ($completion) {
            // Already completed: mark it as pending
            $completion->delete();
        
            $message = 'Class marked as pending!';
        } else {
            // Not completed: mark it as completed
            ClassCompletion::create([
                'user_id' => $user->id,
                'google_event_id' => $eventId,
                'completed_at' => now(),
            ]);
        
            $message = 'Class marked as completed!';
        }
        
        return redirect()
            ->route('dashboard')
            ->with('success', $message);
    }
}