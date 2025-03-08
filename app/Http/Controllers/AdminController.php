<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Offender;
use App\Models\Report;


class AdminController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard');
    }

    public function users(User $user)
    {
        $allUsers = $user::latest()->get();
        return view('admin.users.index', compact('allUsers'));
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
