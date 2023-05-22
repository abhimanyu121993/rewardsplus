@extends('admin-panel.layout.one')
@section('title', 'Company')
@section('bread-crumb')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Store</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Company</li>
                        <li class="breadcrumb-item active">store</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content-area')
    <div class="row mb-3 d-flex justify-content-end ">
        <div class="col-sm-3">
            <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addcompany"
                data-bs-original-title="Add new company" title="Add Company"><i class="fa fa-plus"></i> Add New Store
            </button>
        </div>
        {{-- Modal is below coded at end ofsection --}}

        <div class="col-sm-3">
            <a class="btn btn-warning" href="@if(Route::has(Helper::getGuard().'.store.fetch-old-stores')){{ route(Helper::getGuard().'.store.fetch-old-stores') }}@endif" title="Add Company"><i class="fa fa-rotate-right"></i> Fetch Old data
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header pb-0">
            <h5>Store  List</h5>
        </div>
        <div class="card-body">
            <div class="row">
        <div class="col table-responsive">
            <table class="table table-bordered ">
                <thead class="bg-primary">
                    <tr>
                        <th>Sr No</th>
                        <th>Store Name</th>
                        <th>Company Name</th>
                        <th>Store Email</th>
                        <th>Contact No</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stores as $store)
                    <tr>
                        <td>{{ ($stores->currentPage()*10)+($loop->index + 1) }}</td>
                        <td>{{ $store->name??'' }}</td>
                        <td>{{ $store->company->name??'' }}</td>
                        <td>{{ $store->email??'' }}</td>
                        <td>{{ $store->mobile??'' }}</td>
                        <td>edit delete</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <div class="row mt-2">
        {{ $stores->links("pagination::bootstrap-5") }}
    </div>
        </div>
    </div>

    {{-- Modal for add Company --}}
    <div class="modal fade" id="addcompany" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addcompany" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Store</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                        data-bs-original-title="" title=""></button>
                </div>



            </div>
        </div>
    </div>

            @endsection

