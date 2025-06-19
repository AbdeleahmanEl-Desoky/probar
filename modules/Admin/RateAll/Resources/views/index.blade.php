@extends('admin::layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Ratings</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Ratings</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Shop Name</th>
                            <th>Client Name</th>
                            <th>Schedule Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Rate</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rates as $index => $rate)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $rate['shop_name'] ?? '-' }}</td>
                                <td>{{ $rate['client_name'] ?? '-' }}</td>
                                <td>{{ $rate['schedule_date'] ?? '-' }}</td>
                                <td>{{ $rate['schedule_start_time'] ?? '-' }}</td>
                                <td>{{ $rate['schedule_end_time'] ?? '-' }}</td>
                                <td>{{ $rate['rate'] ? $rate['rate'] : '-' }}</td>
                                <td>{{ $rate['note'] ?? '-' }}</td>
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
