<?php
namespace App\Http\Controllers;

use App\Models\child;
use Illuminate\Http\Request;
use App\Models\GrandFather;
use App\Models\Father;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function showActivityLogs(Request $request)
    {
        $activityLogs = Activity::where(function ($query) {
            $query->where('subject_type', GrandFather::class)
                  ->orWhere('subject_type', Father::class)
                  ->orWhere('subject_type', child::class);;
        })
        ->orderBy('created_at', 'desc')
        ->get();

         //dd($activityLogs);
       return view('activity_logs', ['activityLogs' => $activityLogs]);
    }
}
