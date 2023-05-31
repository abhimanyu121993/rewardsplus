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
        <div class="row">
            <div class="col-md-6">
                <h4>Attendace on  <span class="text-danger">{{ $date }}</span> </h4>
            </div> 
            <div class="col-md-6 pull-right">
                <a href="{{ route(Helper::getGuard().'.attendance.bulk-attendance-get') }}" class="btn btn-primary btn-sm">Export</a>
            </div> 
        </div>
    </div>
    <form action="{{ route(Helper::getGuard().'.attendance.bulk') }}" method="post">
        @csrf
    <div class="card-body table-responsive">
        <table class="table table-bordered data-table">
            <thead class="bg-primary">
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>UUID</th>
                    <th>Clock-In</th>
                    <th>Clock-Out</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($employees as $key => $employee)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->uniqid }} </td>
                    <td> <input type="time" name="{{ $employee->id }}[clock_in]" id="" class="form-control" value="{{ $employee->today_attendance?$employee->today_attendance->clock_in:'' }}" @if(isset($employee->today_attendance) and $employee->today_attendance->clock_in!=null) @if(Auth::guard(Helper::getGuard())->user()->hasPermissionTo('Bulk Attendance_edit','employee')) @else readonly @endif @endif> </td>
                    <td> <input type="time" name="{{ $employee->id }}[clock_out]" id="" class="form-control" value="{{ $employee->today_attendance?$employee->today_attendance->clock_out:'' }}" @if(isset($employee->today_attendance) and $employee->today_attendance->clock_out!=null) @if(Auth::guard(Helper::getGuard())->user()->hasPermissionTo('Bulk Attendance_edit','employee')) @else readonly @endif @endif> </td>
                    <td>
                       <select name="{{ $employee->id }}[status]" id="" class="form-select" @if(isset($employee->today_attendance) and $employee->today_attendance->status!=null) @if(Auth::guard(Helper::getGuard())->user()->hasPermissionTo('Bulk Attendance_edit','employee')) @else disabled @endif @endif>

                        <option value="" disabled selected hidden>Choose Status</option>
                            <option value="present" @isset($employee->today_attendance)@selected($employee->today_attendance->status=='present')@endisset>Present</option>
                            <option value="absent" @isset($employee->today_attendance)@selected($employee->today_attendance->status=='absent')@endisset>Absent</option>
                            <option value="paid-leave" @isset($employee->today_attendance)@selected($employee->today_attendance->status=='paid-leave')@endisset>Paid Leave</option>
                            <option value="unpaid-leave" @isset($employee->today_attendance)@selected($employee->today_attendance->status=='unpaid-leave')@endisset>Unpaid Leave</option>
                            <option value="half-day" @isset($employee->today_attendance)@selected($employee->today_attendance->status=='half-day')@endisset>half-day</option>
                        </select>
                    </td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
    <div class="card-footer d-flex justify-content-end">
        <button class="btn btn-info btn-square">Submit</button>
    </div>
</form>
</div>
@endsection

@section('script-area')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
    $(function () {
        
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route(Helper::getGuard().'.attendance.bulk-attendance-get') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'uniqid', name: 'uniqid'},
              {data: 'clock_in', name: 'clock_in'},
          ],
      });
              
    });
    // Reinitialize Bootstrap dropdowns
     $(document).on('click', '.dropdown-toggle', function() {
        $(this).dropdown('toggle');
    });
  </script>

@endsection