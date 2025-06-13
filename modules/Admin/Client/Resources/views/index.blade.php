@extends('admin::layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Clients</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Clients</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">Clients <small></small></h3>

                <form action="{{ route('admin.clients.index') }}" method="get">
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
                        <th>Image</th> <!-- New -->
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Canceled Schedules</th>
                        <th>Active Schedules</th>
                        <th>Finished Schedules</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $key=> $client)
                        <tr>

                            <td>{{ ++$key }}</td>
                            <td>
                                @if($client['picture_url'])
                                    <img src="{{ $client['picture_url'] }}" alt="Client Image" width="40" height="40" class="img-circle">
                                @else
                                    <img src="{{ asset('default-user.png') }}" alt="Default" width="40" height="40" class="img-circle">
                                @endif
                            </td>
                            <td>{{ $client['name'] }}</td>
                            <td>{{ $client['email'] }}</td>
                            <td>{{ $client['phone'] }}</td>
                            <td>{{ $client['canceled_schedules_count'] }}</td>
                            <td>{{ $client['active_schedules_count'] }}</td>
                            <td>{{ $client['finished_schedules_count'] }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table><!-- end of table -->

                <!-- Pagination -->
                <x-pagination-with-per-page :pagination="$pagination" />
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section>
</div>
@endsection
