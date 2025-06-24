@extends('admin::layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Favorites</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Favorites</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">Favorites <small></small></h3>

                <form action="{{ route('admin.favorites.index') }}" method="get">
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
                            <th>Client</th>
                            <th>Shop</th>
                            <th>City</th>
                            <th>Worker No</th>
                            <th>Average Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($favorites as $index => $favorite)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $favorite['client'] ?? '-' }}</td>
                                <td>{{ $favorite['shop_name'] ?? '-' }}</td>
                                <td>{{ $favorite['city_name'] ?? '-' }}</td>
                                <td>{{ $favorite['worker_no'] ?? '-' }}</td>
                                <td>{{ number_format($favorite['average_rating'] ?? 0, 1) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No favorite clients found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <x-pagination-with-per-page :pagination="$pagination" />
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section>
</div>
@endsection
