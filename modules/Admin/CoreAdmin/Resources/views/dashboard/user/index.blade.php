@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.categories')</h1>

            <ol class="breadcrumb">
                <li><a href="{{-- route('dashboard.welcome') --}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.categories')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.categories') <small></small></h3>

                    <form action="{{-- route('dashboard.categories.index') --}}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
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

                                <tr>
                                    <td></td>
                                    <td></td>

                                </tr>


                            </tbody>

                        </table><!-- end of table -->




                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
