<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Offender;
use App\Models\Report;
use App\Models\PartyRepresentative;
use App\Models\Category;


class AdminController extends Controller
{
    public function dashboard()
    {
        $allUsers = User::latest()->get();
        $allOffenders = Offender::latest()->get();
        $allReports = Report::latest()->get();
        $pendingReps = PartyRepresentative::where('status', 'pending')->count();

        return view('admin.dashboard', compact('allUsers', 'allOffenders', 'allReports', 'pendingReps'));
    }

    public function listRepresentatives()
    {
        $representatives = PartyRepresentative::with(['user', 'party'])->latest()->get();
        return view('admin.representatives.index', compact('representatives'));
    }

    public function approveRepresentative(PartyRepresentative $representative)
    {
        $representative->update(['status' => 'approved']);

        // also update user role
        $representative->user->update(['role' => 'representative']);

        return redirect()->route('admin.representatives.index')->with('success', 'Representative approved.');
    }

    public function rejectRepresentative(PartyRepresentative $representative)
    {
        $representative->update(['status' => 'rejected']);
        return redirect()->route('admin.representatives.index')->with('success', 'Representative rejected.');
    }

    public function assignCategories(PartyRepresentative $representative)
    {
        $categories = Category::all();
        $assignedCategories = $representative->categories()->pluck('id')->toArray();

        return view('admin.representatives.categories', compact('representative', 'categories', 'assignedCategories'));
    }

    public function syncCategories(Request $request, PartyRepresentative $representative)
    {
        $request->validate([
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $representative->categories()->sync($request->categories);

        return redirect()->route('admin.representatives.index')->with('success', 'Categories updated successfully.');
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

    public function offenderEdit(Offender $offender)
    {
        return view('admin.offenders.edit',[
            'offender' => $offender
        ]);
    }

    public function offenderUpdate(Request $request, Offender $offender)
    {

    }

    

    
}
