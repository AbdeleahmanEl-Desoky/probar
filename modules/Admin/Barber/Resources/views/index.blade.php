@extends('admin::layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>barbers</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">barbers</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">barbers <small></small></h3>

                <form action="{{ route('admin.barbers.index') }}" method="get">
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
                        {{-- <th>Image</th> <!-- New --> --}}
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>active</th>
                        <th>shops</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barbers as $key=> $barber)
                        <tr>

                            <td>{{ ++$key }}</td>
                            {{-- <td>
                                @if($barber['picture_url'])
                                <img src="{{ $barber['picture_url'] }}"
                                    class="rounded-circle"
                                    width="40"
                                    height="40"
                                    alt="Barber Image">                                @else
                                    <img src="{{ asset('default-user.png') }}" alt="Default" width="40" height="40" class="img-circle">
                                @endif
                            </td> --}}
                            <td>{{ $barber['name'] }}</td>
                            <td>{{ $barber['email'] }}</td>
                            <td>{{ $barber['phone'] }}</td>
                            <td>
                                @if ($barber['is_active'])
                                    <button class="btn btn-sm btn-success toggle-status" data-id="{{ $barber['id'] }}">Active</button>
                                @else
                                    <button class="btn btn-sm btn-danger toggle-status" data-id="{{ $barber['id'] }}">Inactive</button>
                                @endif
                            </td>
                            <td>{{ $barber['shops_count'] }}</td>
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-status').forEach(button => {
        button.addEventListener('click', function () {
            const barberId = this.dataset.id;

            fetch(`/admin/barbers/${barberId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            })
            .then(res => res.json())
            .then(data => {
                location.reload(); // or update the row dynamically
            });
        });
    });
});
</script>
@endsection

