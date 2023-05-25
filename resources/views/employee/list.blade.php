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
            <a class="btn btn-warning"
                href="@if (Route::has(Helper::getGuard() . '.company.fetch-old-employees')) {{ route(Helper::getGuard() . '.company.fetch-old-employees') }} @endif"
                title="Add Employee"><i class="fa fa-rotate-right"></i> Fetch Old data
            </a>
        </div>
    </div>


    <div class="card">
        <div class="card-header pb-0">
            <h5>Employee List</h5>
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
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employees->currentPage() * 10 + ($loop->index + 1) }}</td>
                                    <td>{{ $employee->name ?? '' }}</td>
                                    <td>{{ $employee->uniqid ?? '' }}</td>
                                    <td>{{ $employee->company->name ?? '' }}</td>
                                    <td>{{ $employee->store->name ?? '' }}</td>
                                    <td>{{ $employee->email ?? '' }}</td>
                                    <td>{{ $employee->mobile ?? '' }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-primary employee_route" href="#"
                                                data-url="{{ route('admin.employee.edit', $employee->id) }}"
                                                data-bs-toggle="modal" data-bs-target="#updateemployee">Edit</a>
                                            <form action="{{ route('admin.employee.destroy', $employee->id) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-primary">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="row mt-2">
                {{ $employees->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    {{-- Modal Start --}}

    <div class="modal fade" id="addemployee" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addcompany"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Employee</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                        data-bs-original-title="" title=""></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.employee.store') }}" accept-charset="UTF-8" class="form"
                        id="m_form_1" enctype="multipart/form-data" novalidate="novalidate">
                        @csrf
                        <div class="portlet__body">
                            <!-- employee Name -->
                            <div class="form__section form__section--first">

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="example_input_full_name">
                                            Emp Type:
                                        </label>
                                        <select class="form-control m-input" id="emp_type" name="emp_type">
                                            <option value="">Select Type</option>

                                            <option value="1"> Admin </option>
                                            <option value="2"> Cashier </option>
                                            <option value="3"> Back Office </option>
                                            <option value="4">Store Manager</option>

                                        </select>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="example_input_full_name">
                                            Emp Code :
                                        </label>
                                        <input type="text" name="emp_code" id="emp_code" placeholder="Emp Code"
                                            class="form-control">

                                    </div>



                                </div>

                                <div class="row">


                                    <div class="form-group col-md-6">
                                        <label for="example_input_full_name">
                                            Name :
                                        </label>
                                        <input type="text" name="name" id="name" placeholder="Name"
                                            class="form-control">

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="contact">
                                            Contact:
                                        </label>
                                        <input type="text" name="contact" id="contact" placeholder="Contact"
                                            class="form-control">
                                        @error('contact')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="example_input_full_name">
                                            Email:
                                        </label>
                                        <input type="text" name="email" id="email" placeholder="Email"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="example_input_full_name">
                                            Password:
                                        </label>
                                        <input class="form-control" id="password" name="password"
                                            placeholder="Password" type="password">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="example_input_full_name">
                                            Choose Company:
                                        </label>
                                        <select class="form-control company-detail" id="store_id" name="company_id">
                                            <option value="">Select Company</option>
                                            @foreach ($data as $company)
                                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="example_input_full_name">
                                            Choose Store:
                                        </label>
                                        <select class="form-control store-detail" id="store_id" name="store_id">
                                        </select>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="pan_no">
                                            Pan No:
                                        </label>
                                        <input type="text" name="pan_no" id="pan_no" placeholder="Pan No"
                                            class="form-control">
                                        @error('pan_no')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="account_no">
                                            Account No:
                                        </label>
                                        <input type="text" name="account_no" id="account_no" placeholder="Account No"
                                            class="form-control">
                                        @error('account_no')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="ifsc_code">
                                            IFSC Code:
                                        </label>
                                        <input type="text" name="ifsc_code" id="ifsc_code" placeholder="IFSC Code"
                                            class="form-control">
                                        @error('ifsc_code')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="example_input_full_name">
                                            Photo:
                                        </label>
                                        <input type="file" class="form-control" id="photo" name="photo">
                                    </div>
                                </div>



                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="example_input_full_name">
                                            Address Proof:
                                        </label>
                                        <input type="file" class="form-control" id="address_proof"
                                            name="address_proof">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="example_input_full_name">
                                            Aadhar:
                                        </label>
                                        <input type="file" class="form-control" id="aadhar" name="aadhar">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="example_input_full_name">
                                            Pancard:
                                        </label>
                                        <input type="file" class="form-control" id="pancard" name="pancard">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="example_input_full_name">
                                            Other:
                                        </label>
                                        <input type="file" class="form-control" id="other" name="other">
                                    </div>

                                </div>
                                <div class="row">


                                    <div class="form-group col-md-6">
                                        <label for="example_input_full_name">
                                            Address :
                                        </label>
                                        <input type="text" name="address" id="address" placeholder="Address"
                                            class="form-control">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="aadhar_no">
                                            Aadhar No :
                                        </label>
                                        <input type="text" name="aadhar_no" id="aadhar_no" placeholder="Aadhar No"
                                            class="form-control">
                                        @error('aadhar_no')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6" style="transform:translate(975px,10px);">
                            <button type="submit" class="btn btn-primary btn-sm" id="SubmIt">
                                Add
                            </button>
                        </div>
                        <!-- roles -->
                        <!-- </form> -->
                    </form>
                </div>



            </div>
        </div>
    </div>

    <div class="modal fade" id="updateemployee" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="updatecompany" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Employee</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                        data-bs-original-title="" title=""></button>
                </div>
                <div class="modal-body inerhtml">

                </div>



            </div>
        </div>
    </div>
@endsection
@section('script-area')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.employee_route', function() {
                $.ajax({
                    url: $(this).data('url'),
                    method: 'get',
                    success: function(data) {
                        $('.inerhtml').html(data);
                        $('#updateemployee').modal('open');
                    }
                });
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.company-detail').on('change', function(event) {
                var company = this.value;
                var newurl = "{{ url('api/fetch-company') }}" + '/' + company;
                $.ajax({
                    url: newurl,
                    type: "get",
                    success: function(response) {
                        $('.store-detail').html(response);
                    }
                });
            });
        });
    </script>
@endsection
