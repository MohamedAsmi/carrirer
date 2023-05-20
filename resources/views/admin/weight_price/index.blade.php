@extends('admin.layouts.app')
@section('page-title', 'Weight Price')
@section('body')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-6">
                <h4 class="fw-bold py-3 mb-4"><span class="fw-light">Weight Price</h4>
            </div>
            <div class="col-6 text-right">
                <a href="javascript:void(0)" class="load-modal" title="Edit" data-url="{{ route('weight-price.create') }}">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <span><i class="fa fa-plus"></i>Create Weight Price</span>
                    </button>
                </a>
            </div>
        </div>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body col-md-12">
                        <table id="weightprice" class="table table-md-8" data-url="{{ route('weightprice.list') }}">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Region</th>
                                    <th>Weight</th>
                                    <th>credits</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('js')
    <script defer src="{{ asset('assets/js/admin/weightprice.js?t=' . config('app.t')) }}"></script>
@endpush
