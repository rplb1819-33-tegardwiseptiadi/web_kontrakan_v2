<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    { 
        $user = auth()->user();
        $activitylog = ActivityLog::withTrashed()->get();
        return view('dashboard.log_activity.index', compact('user', 'activitylog'));
    }
}
