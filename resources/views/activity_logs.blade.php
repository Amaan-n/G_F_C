@extends('layout.base')
@section('title', 'Logs')
@section('content')
<div>
        @if (count($activityLogs) === 0)
            <p>No activity logs found.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped shadow p-3 mb-5 bg-body rounded">
                    <thead class="table-dark">
                        <tr>
                            <th>Event</th>
                            <th>Model</th>
                            <th>Old Value</th>
                            <th>New Value</th>
                            <th>Attribute</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activityLogs as $activity)
                            @php
                                $properties = json_decode($activity->properties, true);
                                $oldValues = $properties['old'] ?? [];
                                $newValues = $properties['attributes'] ?? [];
                            @endphp

                            @if ($activity->description == 'created')
                                <tr>
                                    <td>Created</td>
                                    <td>{{ $activity->subject_type }}</td>
                                    <td>N/A</td>
                                    <td>{!! str_replace(',', ',<br>', json_encode($newValues)) !!}</td>
                                    <td>N/A</td>
                                    <td>{{ $activity->created_at }}</td>
                                </tr>
                            @elseif ($activity->description == 'deleted')
                                <tr>
                                    <td>Deleted</td>
                                    <td>{{ $activity->subject_type }}</td>
                                    <td>{!! str_replace(',', ',<br>', json_encode($oldValues)) !!}</td>
                                    <td>N/A</td>
                                    <td>N/A</td>
                                    <td>{{ $activity->created_at }}</td>
                                </tr>
                            @else
                                @foreach ($newValues as $attribute => $newValue)
                                    <tr>
                                        <td>Updated</td>
                                        <td>{{ $activity->subject_type }}</td>
                                        <td>
                                            @if ($attribute == 'grand_fathers_id')
                                                @php
                                                    $oldGrandfatherName = \App\Models\GrandFather::find($oldValues[$attribute])->name ?? 'N/A';
                                                @endphp
                                                {{ $oldGrandfatherName }}
                                            @elseif ($attribute == 'fathers_id')
                                                @php
                                                    $oldFatherName = \App\Models\Father::find($oldValues[$attribute])->name ?? 'N/A';
                                                @endphp
                                                {{ $oldFatherName }}
                                            @else
                                                {{ $oldValues[$attribute] ?? 'N/A' }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($attribute == 'grand_fathers_id')
                                                @php
                                                    $newGrandfatherName = \App\Models\GrandFather::find($newValue)->name ?? 'N/A';
                                                @endphp
                                                {{ $newGrandfatherName }}
                                            @elseif ($attribute == 'fathers_id')
                                                @php
                                                    $newFatherName = \App\Models\Father::find($newValue)->name ?? 'N/A';
                                                @endphp
                                                {{ $newFatherName }}
                                            @else
                                                {{ $newValue }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($attribute == 'grand_fathers_id' || $attribute == 'fathers_id')
                                                {{ $attribute == 'grand_fathers_id' ? "GrandFather Name" : "Father Name" }}
                                            @else 
                                                {{ $attribute }}
                                            @endif
                                        </td>
                                        <td>{{ $activity->created_at }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
