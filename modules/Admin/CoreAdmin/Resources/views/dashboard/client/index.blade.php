@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>clients</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">client</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">client <small></small></h3>

                    <form action="{{-- route('dashboard.categories.index') --}}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="search" value="{{ request()->search }}">
                            </div>

                        

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">



                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>actions</th>
                            </tr>
                            </thead>
                            <tbody>
                              @foreach ($clients as $key=>$client)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$client->name}}</td>
                                    <td>{{$client->email}}</td>
                                    <td>{{$client->phone}}</td>
                                    <td>
                                        <a href="{{route('admin.client.edit',$client->id)}}">Edit</a>
                                        <form action="{{route('admin.client.delete',$client->id)}}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}

                                        <button type="submit" class="btn btn-primary"></i>Delete</button>

                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table><!-- end of table -->

                        {{ $clients->appends(request()->query())->links() }}



                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
