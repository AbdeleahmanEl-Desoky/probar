@extends('admin::layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Shops</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Shops</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Shops</h3>

                <form action="{{ route('admin.shops.index') }}" method="get" class="mt-3">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Search"
                                   value="{{ request()->search }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="box-body table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Open</th>
                            <th>Featured</th>
                            <th>Cancelled</th>
                            <th>Active</th>
                            <th>Finished</th>
                            <th>Rating</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shops as $key => $shop)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $shop['name'] }}</td>
                                <td>{{ $shop['is_open'] ? 'Open' : 'Closed' }}</td>
                                <td>
                                    <span class="label label-{{ $shop['featured'] ? 'success' : 'default' }}">
                                        {{ $shop['featured'] ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td>{{ $shop['canceled_schedules_count'] }}</td>
                                <td>{{ $shop['active_schedules_count'] }}</td>
                                <td>{{ $shop['finished_schedules_count'] }}</td>
                                <td>{{ number_format($shop['average_rating'], 1) }}</td>
                                <td>
                                    <button class="btn btn-xs btn-info toggle-details" data-id="{{ $shop['id'] }}">
                                        Show Details
                                    </button>
                                </td>
                            </tr>
                            <tr class="shop-details" id="details-{{ $shop['id'] }}" style="display: none;">
                                <td colspan="9">
                                    <strong>City:</strong> {{ $shop['city_name'] }}<br>
                                    <strong>Street:</strong> {{ $shop['street'] }}<br>
                                    <strong>Address 1:</strong> {{ $shop['address_1'] }}<br>
                                    <strong>Address 2:</strong> {{ $shop['address_2'] }}<br>

                                    <hr>
                                    <strong>Shop Hours:</strong>
                                    <ul>
                                        @foreach ($shop['shop_hours'] as $hour)
                                            <li>
                                                {{ ucfirst($hour->day) }}:
                                                {{ \Carbon\Carbon::parse($hour->opening_time)->format('h:i A') }} -
                                                {{ \Carbon\Carbon::parse($hour->closing_time)->format('h:i A') }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No shops found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <x-pagination-with-per-page :pagination="$pagination" />
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    document.querySelectorAll('.toggle-details').forEach(button => {
        button.addEventListener('click', function () {
            const shopId = this.dataset.id;
            const detailsRow = document.getElementById('details-' + shopId);
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
@endpush
@endsection
