@extends('admin-panel.layout.one')
@section('title', 'Company')
@section('bread-crumb')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Employee</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Company</li>
                        <li class="breadcrumb-item active">employee</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content-area')
<div class="row mb-3 d-flex justify-content-end ">
    <div class="col-sm-3">
        <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addemployee"
            data-bs-original-title="Add new employee" title="Add employee"><i class="fa fa-plus"></i> Add New Employee
        </button>
    </div>
    {{-- Modal is below coded at end ofsection --}}

    <div class="col-sm-3">
        <a class="btn btn-warning" href="@if(Route::has(Helper::getGuard().'.company.fetch-old-employees')){{ route(Helper::getGuard().'.company.fetch-old-employees') }}@endif" title="Add Employee"><i class="fa fa-rotate-right"></i> Fetch Old data
        </a>
    </div>
</div>


<div class="card">
    <div class="card-header pb-0">
        <h5>Employee  List</h5>
    </div>
    <div class="card-body">
        <div class="row">
    <div class="col table-responsive">
        <table class="table table-bordered ">
            <thead class="bg-primary">
                <tr>
                    <th>Sr No</th>
                    <th>Name</th>
                    <th>UUID</th>
                    <th>Email</th>
                    <th>Company Name</th>
                    <th>Store Name</th>
                    <th>Contact No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>{{ ($employees->currentPage()*10)+($loop->index + 1) }}</td>
                    <td>{{ $employee->name??'' }}</td>
                    <td>{{ $employee->uniqid??'' }}</td>
                    <td>{{ $employee->company->name??'' }}</td>
                    <td>{{ $employee->store->name??'' }}</td>
                    <td>{{ $employee->email??'' }}</td>
                    <td>{{ $employee->mobile??'' }}</td>
                    <td>edit delete</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
<div class="row mt-2">
    {{ $employees->links("pagination::bootstrap-5") }}
</div>
    </div>
</div>
@endsection
