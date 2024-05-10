@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div
        class="table-responsive rounded"
    >
        <table
            class="table table-primary"
        >
            <thead>
                <tr>
                    <th scope="col">Doctor Name</th>
                    <th scope="col">specialization</th>
                    <th scope="col">Booked Date</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histories as $history)
                <tr class="">
                    <td scope="row">{{ $history->name }}</td>
                    <td>{{ $history->specialization }}</td>
                    <td> {{ \Carbon\Carbon::parse($history->appointment_datetime)->format('Y-m-d') }} </td>
                    <td>{{ $history->status }}</td>
                </tr>
               @endforeach
            </tbody>
        </table>
    </div>
    
</div>

@endsection