<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Child;
use App\Models\GrandFather;
use App\Models\Father;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Pagination\LengthAwarePaginator;

class ActivityController extends Controller
{
    public function showActivityLogs(Request $request)
    {
        $grandFatherLogs = Activity::where('subject_type', GrandFather::class)->get();
        $fatherLogs = Activity::where('subject_type', Father::class)->get();
        $childLogs = Activity::where('subject_type', Child::class)->get();

        // Merge collections
        $allLogs = $grandFatherLogs->concat($fatherLogs)->concat($childLogs);

        // Pagination
        $perPage = 3;
        $currentPage = $request->input('page', 1); // Get current page from query parameter
        $currentItems = $allLogs->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginator = new LengthAwarePaginator($currentItems, $allLogs->count(), $perPage, $currentPage);

        // Append the necessary query parameters to the pagination links
        $paginator->appends(['page' => $currentPage]);

        return view('activity_logs', ['allLogs' => $paginator]);
    }
}
