@extends('admin::layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Shops</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">shops</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">shops <small></small></h3>

                <form action="{{ route('admin.shops.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request()->search }}">
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i> Search
                            </button>

                        </div>
                    </div>
                </form>
            </div><!-- /.box-header -->

            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Open</th>
                            <th>Featured</th>
                            <th>Canceled Schedules</th>
                            <th>Active Schedules</th>
                            <th>Finished Schedules</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shops as $key => $shop)
                            <tr>
                                <td>{{ ++$key }}</td>
                            
                                <td>{{ $shop['name'] }}</td>
                                <td>{{ $shop['is_open'] ? 'Open' : 'Closed' }}</td>
                                <td>
                                    <span class="label label-{{ $shop['featured'] ? 'success' : 'default' }}">
                                        {{ $shop['featured'] ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td>{{ $shop['canceled_schedules_count'] }}</td> <br>
                                <td>{{ $shop['active_schedules_count'] }}</td> <br>
                                <td>{{ $shop['finished_schedules_count'] }}</td>
                                <td>
                                    <button class="btn btn-xs btn-info toggle-details" data-id="{{ $shop['id'] }}">Show Details</button>
                                </td>
                            </tr>
                            <tr class="shop-details" id="details-{{ $shop['id'] }}" style="display: none;">
                                <td colspan="7">
                                    <strong>City: </strong> {{ $shop['city_name'] }}<br>
                                    <strong>Street:</strong> {{ $shop['street'] }}<br>
                                    <strong>Address 1:</strong> {{ $shop['address_1'] }}<br>
                                    <strong>Address 2:</strong> {{ $shop['address_2'] }}<br>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                <!-- Pagination -->
                <x-pagination-with-per-page :pagination="$pagination" />
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section>
</div>


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
@endsection
