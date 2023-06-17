@extends('admin.layouts.app')
@section('page-title', 'Weight Price')
@section('body')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-6">
                <h4 class="fw-bold py-3 mb-4"><span class="fw-light">User Weight Price</h4>
            </div>
            <div class="col-6 text-right">
            </div>
        </div>

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="select_user" class="form-label">Select setting group</label>
                                    <input type="hidden" value="" id="userId" />
                                    <select name="user" class="form-control" id="select_user">
                                        {{-- @foreach ($parentSettings as $i => $parentSetting)
                                            <option {{ $i == 0 ? 'selected' : '' }} value="{{ $parentSetting->id }}">
                                                {{ $parentSetting->value }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <label for="select_setting_group" class="form-label">&nbsp;</label>
                                <a href="javascript:void(0)" class="w-100 d-block load-modal" title="Edit"
                                    data-url="{{ route('weight-price.create') }}">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal">
                                        <span><i class="fa fa-plus"></i>Create Weight Price</span>
                                    </button>
                                </a>
                                {{-- <small class="form-text text-muted">Create weight price for selected user</small> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

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
