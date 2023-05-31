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
                                        @foreach($data as $data)
                                        <option value="{{$data->id}}" {{isset($store)? ($store->company_id == $data->id ? 'selected' :''):''}}>{{$data->company_name}}</option>
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
                                    </label>
                                    <img src="{{asset('storage/'.$store->employee->photo)}}" style="height:70px;width:70px;" class="rounded" alt="np found">
                                    <input type="file" value="{{$store->photo}}" class="form-control" id="photo" name="photo">
                                </div>
                            </div>



                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Address Proof:
                                    </label>
                                    <img src="{{asset('storage/'.$store->employee->address_proof)}}" style="height:70px;width:70px;" class="rounded" alt="np found">
                                    <input type="file" class="form-control" id="address_proof" name="address_proof">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Aadhar:
                                    </label>
                                    <img src="{{asset('storage/'.$store->employee->adhar_img)}}" style="height:70px;width:70px;" class="rounded" alt="np found">
                                    <input type="file" class="form-control" id="aadhar" name="aadhar">
                                </div>

                            </div>

                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Pancard:
                                    </label>
                                    <img src="{{asset('storage/'.$store->employee->pancard_img)}}" style="height:70px;width:70px;" class="rounded" alt="np found">
                                    <input type="file" class="form-control" id="pancard" name="pancard">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Other:
                                    </label>
                                    <img src="{{asset('storage/'.$store->employee->other_img)}}" style="height:70px;width:70px;" class="rounded" alt="np found">
                                    <input type="file" class="form-control" id="other" name="other">
                                </div>

                            </div>
                            <div class="row">


                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Address :
                                    </label>
                                    <input type="text" name="address" value="{{$store->employee->address??''}}" id="address" placeholder="Address"
                                        class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="example_input_full_name">
                                        Aadhar No :
                                    </label>
                                    <input type="text" name="aadhar_no" value="{{$store->employee->adhar_number??''}}" id="aadhar_no" placeholder="Aadhar No"
                                        class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6" style="transform:translate(975px,10px);">
                        <button type="submit" class="btn btn-primary btn-sm" id="SubmIt">
                            Update
                        </button>
                    </div>
                    <!-- roles -->
                    <!-- </form> -->
                </form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.company-detail').on('change', function(event) {
        var company = this.value;
        var newurl = "{{url('api/fetch-store')}}" + '/' + company;
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