@extends('admin::layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Help Messages</h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($helpMessages as $index => $help)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $help['name'] ?? '-' }}</td>
                                <td>{{ $help['email'] ?? '-' }}</td>
                                <td>{{ $help['phone'] ?? '-' }}</td>
                                <td>{{ $help['subject'] ?? '-' }}</td>
                                <td>{{ $help['message'] ?? '-' }}</td>
                                <td>
                                    @if ($help['type'] === 'client')
                                        <i class="fa fa-user text-primary" title="Client"></i> Client
                                    @elseif ($help['type'] === 'barber')
                                        <i class="fa fa-scissors text-success" title="Barber"></i> Barber
                                    @else
                                        {{ ucfirst($help['type']) }}
                                    @endif
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
@endsection
