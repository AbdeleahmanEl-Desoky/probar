@extends('admin::layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Shops Services</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Shops Services</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">shops-services <small></small></h3>

                <form action="{{ route('admin.shops-services.index') }}" method="get">
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
                    {{-- <th>Image</th> --}}
                    <th>Service Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Time (mins)</th>
                    <th>Shop Name</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($shopsServices as $key => $service)
                        <tr>
                            <td>{{ ++$key }}</td>
                            {{-- <td>
                                @if($service['picture_url'])
                                    <img src="{{ $service['picture_url'] }}" alt="Service Image" width="40" height="40" class="img-circle">
                                @else
                                    <img src="{{ asset('default-user.png') }}" alt="Default" width="40" height="40" class="img-circle">
                                @endif
                            </td> --}}
                            <td>{{ $service['name'] }}</td>
                            <td>{{ $service['description'] }}</td>
                            <td>{{ $service['price'] }}</td>
                            <td>{{ $service['time'] }}</td>
                            <td>{{ $service['shop_name'] ?? 'N/A' }}</td>
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
@endsection
