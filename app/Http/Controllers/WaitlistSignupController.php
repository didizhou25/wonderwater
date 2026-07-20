<?php

namespace App\Http\Controllers;

use App\Models\WaitlistSignup;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WaitlistSignupController extends Controller
{
    /**
     * Store a new waitlist / "Join the Movement" signup.
     */
    public function store(Request $request): RedirectResponse
    {
        // Honeypot: real visitors never fill this hidden field in.
        if (filled($request->input('company_website'))) {
            return back()->with('wonderwater_status', 'joined');
        }

        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:waitlist_signups,email'],
            'interest' => ['nullable', 'in:drink,skin,both'],
        ], [
            'email.unique' => 'Dit e-mailadres staat al op de wachtlijst.',
            'email.email' => 'Vul een geldig e-mailadres in.',
        ]);

        WaitlistSignup::create([
            'name' => $validated['name'] ?? null,
            'email' => $validated['email'],
            'interest' => $validated['interest'] ?? null,
            'source' => 'homepage-movement',
        ]);

        return back()->with('wonderwater_status', 'joined');
    }
}
