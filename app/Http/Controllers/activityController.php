<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\child;
use App\Models\grandFather;
use App\Models\father;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Pagination\LengthAwarePaginator;



class activityController extends Controller
{


    public function showActivityLogs()
    {


        $grandFatherLogs = Activity::where('subject_type', GrandFather::class)->get();
        $fatherLogs = Activity::where('subject_type', Father::class)->get();
        $childLogs = Activity::where('subject_type', Child::class)->get();

        $allLogs = $grandFatherLogs->merge($fatherLogs)->merge($childLogs);

        $perPage = 3;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $allLogs->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginator = new LengthAwarePaginator($currentItems, $allLogs->count(), $perPage, $currentPage);

        // Append the necessary query parameters to the pagination links
        $paginator->appends(['allLogs' => $currentPage]);

        return view('activity_logs', ['allLogs' => $paginator]);




    }

}
