@extends('admin::layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Reports</h1>
            <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Reports</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Shop Name</th>
                            <th>Client Name</th>
                            <th>Schedule Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Note</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $index => $report)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $report['shop_name'] ?? '-' }}</td>
                                <td>{{ $report['client_name'] ?? '-' }}</td>
                                <td>{{ $report['schedule_date'] ?? '-' }}</td>
                                <td>{{ $report['schedule_start_time'] ?? '-' }}</td>
                                <td>{{ $report['schedule_end_time'] ?? '-' }}</td>
                                <td>{{ $report['note'] ?? '-' }}</td>
                                <td>
                                    @if ($report['type'] === 'client')
                                        <i class="fa fa-user text-primary" title="Client"></i> Client
                                    @elseif ($report['type'] === 'barber')
                                        <i class="fa fa-scissors text-success" title="Barber"></i> Barber
                                    @else
                                        {{ ucfirst($report['type']) }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <x-pagination-with-per-page :pagination="$pagination" />
            </div>
        </div>
    </section>
</div>
@endsection
