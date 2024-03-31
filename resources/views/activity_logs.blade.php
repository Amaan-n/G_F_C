@extends('layout.base')
@section('title', 'Logs')
@section('content')
    <div class="container">
        @if (count($activityLogs) === 0)
            <p>No activity logs found.</p>
        @else
            <div class="table-responsive" >
                <table class="table table-bordered table-striped">
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
                                        <td>{{ $oldValues[$attribute] ?? 'N/A' }}</td>
                                        <td>{{ $newValue }}</td>
                                        <td>{{ $attribute }}</td>
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
