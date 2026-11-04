<?php

namespace App\Services;

use App\Models\User;
use RuntimeException;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;


class GoogleCalendarService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getWeeklyEvents(User $user): array 
    {
        $token = $user->googleCalendarToken;

        if (!$token) return [];
        

        // Get a valid access token
        $accessToken = $this->getValidAccessToken($token);

        // Define today's date range in Indian timezone
        $today = now('Asia/Kolkata');
        #$today->copy() make separate copy of original date

        $start = $today->copy()->startOfWeek(Carbon::MONDAY);
        $end = $today->copy()->endOfWeek(Carbon::SUNDAY);

        #toRfc3339String  RFC 3339 format " 2026-10-26T00:00:00+05:30" convert carbon date onject into date time string as in google calendar Api do

        $timeMin = $start->toRfc3339String();
        $timeMax = $end->toRfc3339String();

        $response = Http::withToken($accessToken)
        ->get(
            'https://www.googleapis.com/calendar/v3/calendars/primary/events',
            [
                'timeMin' => $timeMin,
                'timeMax' => $timeMax,
                'singleEvents' => 'true', #recurring events ko individual events mein expand karega.
                'orderBy' => 'startTime', #start time ke according sort karega
                'maxResults' => 100,
            ]
        );

        if ($response->failed()) {
            throw new RuntimeException(
                'Google API Error: HTTP ' .
                $response->status() . ' - ' .
                $response->body()
            );
        }
        return $response->json('items', []);


    }

    private function getValidAccessToken($token): string
    {
        // Check whether access token is still valid
        if (
            $token->expires_at &&
            $token->expires_at->gt(now()->addMinute())
        ) {
            return $token->access_token;
        }

        if (!$token->refresh_token) {
            throw new RuntimeException(
                'Google refresh token is missing.'
            );
        }

        // Request a new access token from Google
        $response = Http::asForm()->post(
            'https://oauth2.googleapis.com/token',
            [
                'client_id' => config('services.google.client_id'),
                'client_secret' => config('services.google.client_secret'),
                'refresh_token' => $token->refresh_token,
                'grant_type' => 'refresh_token',
            ]
        );

        if ($response->failed()) {
            throw new RuntimeException(
                'Unable to refresh Google access token.'
            );
        }

        $data = $response->json();

        // Save the new access token
        $token->update([
            'access_token' => $data['access_token'],
            'expires_at' => now()->addSeconds($data['expires_in']),
        ]);

        return $token->access_token;
    }
}
