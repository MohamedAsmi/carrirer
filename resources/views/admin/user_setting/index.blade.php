@extends('admin.layouts.app')
@section('page-title', 'User')
@section('body')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-6">
                <h4 class="fw-bold py-3 mb-4"><span class="fw-light"><span
                            class="text-bold">{{ $user->first_name . ' ' . $user->last_name }}</span>'s settings </h4>
            </div>
            <div class="col-6 text-right">
                {{-- <a href="javascript:void(0)" class="load-modal" title="Edit" data-url="{{ route('user.add') }}">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <span><i class="fa fa-plus"></i>Create User</span>
                    </button> </a> --}}
            </div>
        </div>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body col-md-6">
                        <div class="form-group">
                            <label for="select_setting_group" class="form-label">Select setting group</label>
                            <select name="setting_group" class="form-control" id="select_setting_group">
                                @foreach ($parentSettings as $i => $parentSetting)
                                    <option {{ $i == 0 ? 'selected' : '' }} value="{{ $parentSetting->id }}">
                                        {{ $parentSetting->value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body col-md-6">
                        <form class="form-horizontal" id="ajax-form" method="POST"
                            action="{{ route('user-setting.update') }}" enctype="multipart/form-data" data-file="true"
                            data-notification="">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}" />
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-md-8" id='settingsTable'>
                                        <thead>
                                            <tr>
                                                <th>Setting</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12" style="text-aligh: right">
                                    <button class="btn btn-primary float-end" type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('assets/js/admin/user.js?t=' . config('app.t')) }}"></script>
@endpush
