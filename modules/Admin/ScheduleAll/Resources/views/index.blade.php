@extends('admin::layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Schedules</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Schedules {{ $tab }}</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Schedules {{ $tab }}</h3>
            </div>

            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Phone</th>
                            <th>Shop</th>
                            <th>Time</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $key => $schedule)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $schedule['client_name'] }}</td>
                                <td>{{ $schedule['client_phone'] }}</td>
                                <td>{{ $schedule['shop_name'] }}</td>
                                <td>{{ $schedule['start_time'] }} - {{ $schedule['end_time'] }}</td>
                                <td>{{ $schedule['schedule_date'] }}</td>
                                <td>{{ ucfirst($schedule['status']) }}</td>
                                <td>
                                    <button class="btn btn-xs btn-info toggle-details" data-id="{{ $schedule['id'] }}">
                                        Show Details
                                    </button>
                                </td>
                            </tr>

                            <tr class="schedule-details" id="details-{{ $schedule['id'] }}" style="display: none;">
                                <td colspan="8">
                                    <strong>Note:</strong> {{ $schedule['note'] ?? '-' }}<br>
                                    <strong>Shop City:</strong> {{ $schedule['city'] ?? '-' }}<br>
                                    <strong>ShopAddress 1:</strong> {{ $schedule['address_1'] ?? '-' }}<br>
                                    <strong>Shop Address 2:</strong> {{ $schedule['address_2'] ?? '-' }}<br>
                                    <strong>Shop Payment:</strong> {{ ucfirst($schedule['payment']) }}<br>
                                    <strong>Shop Rate:</strong> {{ $schedule['shop_rate'] ?? 'N/A' }}
                                    <hr>
                                    <strong>Services:</strong>
                                    <div class="row">
                                        @foreach ($schedule['shop_services'] as $service)
                                            <div class="col-md-4">
                                                <div class="box box-solid">
                                                    <div class="box-body text-center">
                                                        @if($service['picture_url'])
                                                            <img src="{{ $service['picture_url'] }}" alt="Service Image" width="80" height="80" class="img-circle">
                                                        @else
                                                            <img src="{{ asset('default-user.png') }}" alt="Default" width="80" height="80" class="img-circle">
                                                        @endif
                                                        <p><strong>{{ $service['name'] }}</strong></p>
                                                        <p>{{ $service['description'] }}</p>
                                                        <p><strong>Price:</strong> {{ $service['price'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
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

<script>
    document.querySelectorAll('.toggle-details').forEach(button => {
        button.addEventListener('click', function () {
            const scheduleId = this.dataset.id;
            const detailsRow = document.getElementById('details-' + scheduleId);
            if (detailsRow.style.display === 'none') {
                detailsRow.style.display = 'table-row';
                this.textContent = 'Hide Details';
            } else {
                detailsRow.style.display = 'none';
                this.textContent = 'Show Details';
            }
        });
    });
</script>
@endsection
