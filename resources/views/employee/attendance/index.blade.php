@extends('admin-panel.layout.one')
@section('title', 'Attendance')
@section('bread-crumb')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Attendance</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Employee</li>
                        <li class="breadcrumb-item active">attendance</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content-area')
<div class="card">
    <div class="card-header pb-0">
        <h6>Mark Today Attendance</h6>
    </div>
    <div class="card-body">
        <div class="row d-flex justify-content-center">
            <div class="col-4">
                
                <button  class="btn btn-square btn-primary"  onclick="clock_in()" @disabled($today)><i class="fa fa-clock-o"></i> Clock-in ( {{ Carbon\Carbon::now()->format('h:i a') }} )</button>
            </div>
            <div class="col-4">
                <button class="btn btn-square btn-danger" onclick="clock_out()" @disabled($today?false:true)> <i class="fa fa-clock-o"></i> Clock-out ( {{ Carbon\Carbon::now()->format('h:i a') }} )</button>
            </div>

        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">Attendace List</div>
    <div class="card-body">
        <table class="table table-brdered">
            <thead class="bg-primary">
                <tr>
                    <th>Sr No</th>
                    <th>Date</th>
                    <th>Clock - In</th>
                    <th>Clock - Out</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                <tr>
                    <td>{{ (($attendances->currentPage()-1)*10)+($loop->index+1) }}</td>
                    <td>{{ $attendance->created_at->format('d-M-Y') }}</td>
                    <td>{{ $attendance->clock_in->format('d-m-Y h:i a') }}</td>
                    <td>{{ $attendance->clock_out?$attendance->clock_out->format('d-m-Y h:i a'):'' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
       
    </div>
    <div class="card-footer ">
        {{ $attendances->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
@section('script-area')
<script>
    function clock_in(){
        window.location.href="{{ route(Helper::getGuard().'.attendance.clock-in') }}";
    }
    function clock_out(){
        window.location.href="{{ route(Helper::getGuard().'.attendance.clock-out') }}";
    }
</script>
@endsection