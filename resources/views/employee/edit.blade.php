<form method="POST" action="{{route('admin.employee.store')}}" accept-charset="UTF-8" class="form"
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
                                    <input type="text" value="{{$store->employee->emp_code??''}}" name="emp_code" id="emp_code" placeholder="Emp Code"
                                        class="form-control">

                                </div>



                            </div>

                            <div class="row">


                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Name :
                                    </label>
                                    <input type="text" value="{{$store->name??''}}" name="name" id="name" placeholder="Name" class="form-control">

                                </div>

                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Contact:
                                    </label>
                                    <input type="text" value="{{$store->mobile??''}}" name="contact" id="contact" placeholder="Contact"
                                        class="form-control">
                                </div>


                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Email:
                                    </label>
                                    <input type="text" name="email" value="{{$store->email??''}}" id="email" placeholder="Email" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Choose Company:
                                    </label>
                                    <select class="form-control company-detail" id="store_id" name="company_id">
                                        <option value="">Select Company</option>
                                        @foreach($data as $company)
                                        <option value="{{$company->id}}">{{$company->company_name}}</option>
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
                                    <label for="example_input_full_name">
                                        Pan No:
                                    </label>
                                    <input type="text" value="{{$store->employee->pan_number??''}}" name="pan_no" id="pan_no" placeholder="Pan No"
                                        class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Account No:
                                    </label>
                                    <input type="text" value="{{$store->employee->account_number??''}}" name="account_no" id="account_no" placeholder="Account No"
                                        class="form-control">
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        IFSC Code:
                                    </label>
                                    <input type="text" name="ifsc_code" value="{{$store->employee->ifsc_code??''}}" id="ifsc_code" placeholder="IFSC Code"
                                        class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Photo:
                                    </label><img src="{{asset('storage/Employee'.$store->employee->photo??'')}}"/>
                                    <input type="file" class="form-control" id="photo" name="photo">
                                </div>
                            </div>



                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Address Proof:
                                    </label>
                                    <input type="file" class="form-control" id="address_proof" name="address_proof">
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
                                    <label for="example_input_full_name">
                                        Aadhar No :
                                    </label>
                                    <input type="text" name="aadhar_no" id="aadhar_no" placeholder="Aadhar No"
                                        class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6" style="transform:translate(400px,30px);">
                        <button type="submit" class="btn btn-primary btn-sm" id="SubmIt">
                            Update
                        </button>
                    </div>
                    <!-- roles -->
                    <!-- </form> -->
                </form>