@extends('layouts.app')
@section('page-title', 'Dashboard')
@section('body')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-6">
                <h4 class="fw-bold py-3 mb-4"><span class="fw-light">Marketplace Orders</h4>
            </div>
            <div class="col-6 text-right">
                <button class="btn btn-primary" id="syncBtn"
                    {{ isset($orderSyncingStatus->status) && $orderSyncingStatus->status == 'running' ? 'disabled' : '' }}
                    data-url="{{ route('marketplace.order.sync') }}">
                    <span><i class="fa fa-plus"></i>Sync Orders</span>
                </button>
            </div>
        </div>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body col-md-12">
                        @if (isset($orderSyncingStatus->status) && $orderSyncingStatus->status == 'running')
                            <div class="alert alert-success">
                                {{ __('Orders are currently being synchronized') }}
                            </div>
                        @endif
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
                        <table id="marketplace_order" class="table table-md-8"
                            data-url="{{ route('marketplace.order.list') }}">
                            <thead>
                                <tr>
                                    <th>Order ID (Marketplace)</th>
                                    <th>Marketplace</th>
                                    <th>Products</th>
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
    <script defer src="{{ asset('assets/js/marketplace_order.js?t=' . config('app.t')) }}"></script>
@endsection
