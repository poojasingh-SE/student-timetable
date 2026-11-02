<?php

namespace App\Http\Controllers;

use App\Models\HomeworkTask;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class HomeworkTaskController extends Controller
{
    public function index(): View
    {
        $homeworkTasks = auth()->user()
            ->homeworkTasks()
            ->orderBy('due_at')
            ->get();

        return view('homework.index', compact('homeworkTasks'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate form fields
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:100',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'due_time' => 'required|date_format:H:i',
        ]);

        // Combine date and time into one datetime value
        $validated['due_at'] = $validated['due_date']
            . ' ' . $validated['due_time'];

        // Remove separate date and time fields
        unset($validated['due_date'], $validated['due_time']);

        // Save homework for logged-in user
        auth()->user()->homeworkTasks()->create($validated);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Homework added successfully!');
    }
    public function update(
        Request $request,
        HomeworkTask $homeworkTask
    ): RedirectResponse {
    
        // Check task ownership
        abort_unless(
            $homeworkTask->user_id === auth()->id(),
            403
        );
    
        // Validate input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:100',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'due_time' => 'required|date_format:H:i',
        ]);
    
        // Combine date and time
        $validated['due_at'] = $validated['due_date']
            . ' ' . $validated['due_time'];
    
        unset($validated['due_date'], $validated['due_time']);
    
        // Update homework
        $homeworkTask->update($validated);
    
        return redirect()
            ->route('dashboard')
            ->with('success', 'Homework updated successfully!');
    }
    public function destroy(HomeworkTask $homeworkTask): RedirectResponse
    {
        // Check task ownership
        abort_unless(
            $homeworkTask->user_id === auth()->id(),
            403
        );

        // Delete homework
        $homeworkTask->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Homework deleted successfully!');
    }
    public function toggleComplete(
        Request $request,
        HomeworkTask $homeworkTask
    ): JsonResponse|RedirectResponse {
    
        // Check task ownership
        abort_unless(
            $homeworkTask->user_id === auth()->id(),
            403
        );
    
        // Toggle completion status
        if ($homeworkTask->completed_at) {
            $homeworkTask->update([
                'completed_at' => null,
            ]);
        } else {
            $homeworkTask->update([
                'completed_at' => now('Asia/Kolkata'),
            ]);
        }
        $homeworkTask->refresh();

        $isCompleted = !is_null($homeworkTask->completed_at);
        
        $isOverdue = !$isCompleted && $homeworkTask->due_at->isPast();
        
        return response()->json([
            'success' => true,
            'completed' => $isCompleted,
            'overdue' => $isOverdue,
            'message' => 'Homework status updated successfully!',
        ]);
    
        // Normal form submission fallback
        return redirect()
            ->route('dashboard')
            ->with('success', 'Homework status updated successfully!');
    }
}