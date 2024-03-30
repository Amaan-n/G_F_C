@extends('layout.base')

@section('title', 'Logs')

@section('content')
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Event</th>
                    <th>Subject Type</th>
                    <th>New Values</th>
                    <th>Old Values</th>
                    <th>Update Time</th> 
                </tr>
            </thead>
            <tbody class="table-strapped">
                  @foreach ($allLogs as $log)
                    <tr>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->subject_type }}</td>
                        <td>
                            @if (!empty($log->properties))
                                <?php $properties = json_decode($log->properties, true); ?>
                                @if (isset($properties['attributes']))
                                    <ul>
                                        @foreach ($properties['attributes'] as $attribute => $newValue)
                                            <li><strong>{{ ucfirst($attribute) }}:</strong> {{ $newValue }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No attribute changes recorded.</p>
                                @endif
                            @else
                                <p>No properties recorded.</p>
                            @endif
                        </td>
                        <td>
                            @if (!empty($log->properties) && isset($properties['old']))
                                <ul>
                                    @foreach ($properties['old'] as $attribute => $oldValue)
                                        <li><strong>{{ ucfirst($attribute) }}:</strong> {{ $oldValue }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>N/A</p>
                            @endif
                        </td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
         <div class="pagination justify-content-center">
                {!! $allLogs->links() !!}
            </div>
    </div>
@endsection
