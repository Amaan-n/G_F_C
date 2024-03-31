<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GrandFather;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function showActivityLogs(Request $request)
    {
        // Retrieve activity logs for GrandFather model
        $activityLogs = Activity::where('subject_type', GrandFather::class)
            ->orderBy('created_at', 'desc')
            ->get();

          // dd($activityLogs);
        return view('activity_logs', ['activityLogs' => $activityLogs]);
    }
}
