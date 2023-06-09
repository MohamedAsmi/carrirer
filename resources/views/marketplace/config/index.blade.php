@extends('layouts.app')
@section('page-title', 'Dashboard')
@section('body')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-6">
                <h4 class="fw-bold py-3 mb-4"><span class="fw-light">Marketplace Configurations</h4>
            </div>
            <div class="col-6 text-right">
                {{-- <a href="javascript:void(0)" class="load-modal" title="Add New Configuration"
                    data-url="{{ route('marketplace.config.create') }}">
                    <button type="button" class="btn btn-primary" data-toggle="modal">
                        <span><i class="fa fa-plus"></i>New Configuration</span>
                    </button>
                </a> --}}
            </div>
        </div>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body col-md-12">
                        {{-- <div class="row mb-3">
                            <div class="col-6">
                                <div class="input-group">
                                    <input type="text" class="form-control"
                                        placeholder="Search Marketplace Configuration"
                                        aria-label="Search Marketplace Configuration" aria-describedby="searchMpConfigBtn">
                                    <button class="btn btn-outline-primary" type="button"
                                        id="searchMpConfigBtn">Search</button>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row mb-3">
                            <div class="col-12">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <table id="marketplace_config" class="table table-md-8"
                            data-url="{{ route('marketplace.config.list') }}">
                            <thead>
                                <tr>
                                    <th>Marketplace</th>
                                    <th>Configuration</th>
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

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script defer src="{{ asset('assets/js/marketplace_config.js?t=' . config('app.t')) }}"></script>
@endsection
