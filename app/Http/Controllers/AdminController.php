<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Offender;
use App\Models\Report;


class AdminController extends Controller
{
    public function __invoke(User $user, Offender $offender, Report $report)
    {
        $allUsers = $user::latest()->get();
        $allOffenders = $offender::latest()->get();
        $allReports = $report::latest()->get();

        return view('admin.dashboard',compact('allUsers','allOffenders','allReports'));
    }

    public function users(User $user)
    {
        $allUsers = $user::latest()->get();
        return view('admin.users.index', compact('allUsers'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'role' => 'required|in:user,admin',
        ]);
    
        $user->update($validated);
    
        return redirect()->route('admin.users')
            ->with('success', 'User updated successfully.');
    }

    public function offenders(Offender $offender)
    {
        $allOffenders = $offender::latest()->get();
        return view('admin.offenders.index',compact('allOffenders'));
    }

    public function reports(Report $report)
    {
        $allReports = $report::latest()->get();
        return view('admin.reports.index',compact('allReports'));
    }
}
