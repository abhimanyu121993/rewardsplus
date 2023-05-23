@extends('admin-panel.layout.one')
@section('title', 'Company-attendance')
@section('bread-crumb')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Attendace</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Company</li>
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
        <h3>Attendace</h3>
    </div>
    <form action="{{ route('company.attendance.clock-in') }}" method="post">
        @csrf
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead class="bg-primary">
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>UUID</th>
                    <th>Clock-In</th>
                    <th>Clock-Out</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $key => $employee)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->uniqid }}</td>
                    <td>{{ $employee->today_clock_in ? $employee->today_clock_in->clock_in->format('h:i a'):'' }}</td>
                    <td>{{ $employee->today_clock_out ? $employee->today_clock_out->clock_out->format('h:i a'):'' }}</td>
                    <td>
                        @if($employee->today_clock_in)
                            <button class="btn btn-success"><i class="fa fa-clock-o"></i> Clock-In</button>
                        @else
                            <input type="checkbox" name="employee_id[]" class="form-check" value="{{ $employee->id }}">
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer d-flex justify-content-end">
        <button class="btn btn-info btn-square">Submit</button>
    </div>
</form>
</div>
@endsection