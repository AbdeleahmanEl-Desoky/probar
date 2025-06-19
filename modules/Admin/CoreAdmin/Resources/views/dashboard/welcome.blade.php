@extends('admin::layouts.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            {{-- استخدم المتغيرات المرسلة من الكنترولر --}}
            <h1>{{ $title }}</h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                {{-- الحلاقين --}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $totalBarbers }}</h3>
                            <p>الحلاقين</p>
                            <small style="color:white;">نشط: {{ $activeBarbers }} | غير نشط: {{ $inactiveBarbers }}</small>
                        </div>
                        <div class="icon">
                           <i class="fa fa-cut"></i> {{-- أيقونة مناسبة للحلاق --}}
                        </div>
                        <a href="{{ route('admin.barbers.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- العملاء --}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $totalClients }}</h3>
                            <p>العملاء</p>
                             <small style="color:white;">نشط: {{ $activeClients }} | غير نشط: {{ $inactiveClients }}</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('admin.clients.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- الحجوزات --}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $totalSchedules }}</h3>
                            <p>إجمالي الحجوزات</p>
                             <small style="color:white; display:block;">نشط: {{ $activeSchedules }} | قادم: {{ $upcomingSchedules }} | منتهي: {{ $finishedSchedules }}</small>
                        </div>
                        <div class="icon">
                           <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('admin.schedules.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- المحلات والخدمات --}}
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $totalShops }}</h3>
                            <p>المحلات</p>
                            <small style="color:white;">{{ $totalServices }} خدمة متاحة</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-building"></i>
                        </div>
                        <a href="{{ route('admin.shops.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div><!-- end of row -->

            <div class="box box-solid">
                <div class="box-header">
                    <h3 class="box-title">رسم بياني للحجوزات (آخر 12 شهر)</h3>
                </div>
                <div class="box-body border-radius-none">
                    <div class="chart" id="line-chart" style="height: 250px;"></div>
                </div>
                <!-- /.box-body -->
            </div>

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection

@push('scripts')
    {{-- تأكد من أن مكتبة Morris.js مُضمّنة في مشروعك --}}
    <script>
        //line chart
        var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: [
                @foreach ($schedules_chart_data as $data)
                {
                    ym: "{{ $data->year }}-{{ $data->month }}",
                    sum: "{{ $data->sum }}"
                },
                @endforeach
            ],
            xkey: 'ym',
            ykeys: ['sum'],
            labels: ['إجمالي الحجوزات'],
            lineWidth: 2,
            hideHover: 'auto',
            gridStrokeWidth: 0.4,
            pointSize: 4,
            gridTextFamily: 'Open Sans',
            gridTextSize: 10,
            xLabelFormat: function (x) { // لتنسيق التسمية على محور السينات
                var month = x.getMonth() + 1;
                return x.getFullYear() + '-' + (month < 10 ? '0' : '') + month;
            },
            dateFormat: function (x) { // لتنسيق التاريخ عند المرور بالفأرة
                 var month = new Date(x).getMonth() + 1;
                 var year = new Date(x).getFullYear();
                return year + '-' + (month < 10 ? '0' : '') + month;
            },
        });
    </script>
@endpush
