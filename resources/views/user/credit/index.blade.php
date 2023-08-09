@extends('layouts.app')
@section('page-title', 'Credit History')
@section('body')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-6">
                <h4 class="fw-bold py-3 mb-4"><span class="fw-light">Credit History</h4>
            </div>
            <div class="col-6 text-right">
                <a href="javascript:void(0)" class="load-modal" title="Edit" data-url="{{ route('credit.add') }}">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <span><i class="fa fa-plus"></i>Create New</span>
                    </button> </a>
            </div>
        </div>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="card-body col-md-12">
                        <form id="credits_tabley" >
                            <div class="row">
                              <div class="form-group col-md-6">
                                <label for="inputEmail4">Date From:</label>
                                <input type="date" id="min" name="min" class="form-control">
                              </div>
                              <div class="form-group col-md-6">
                                <label for="inputPassword4">Date To:</label>
                                <input type="date" id="max" name="max" class="form-control">
                              </div>
                            </div>
                          
                          </form>
                        <table id="credits_table" class="table table-md-8" data-url="{{ route('credit.list') }}">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Credit Added</th>
                                    <th>Credit Balance</th>
                                    <th>Total</th>
                                    <th>Source</th>
                                    <th>Details</th>
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
    <script src="{{ asset('assets/js/user/credit.js?t=' . config('app.t')) }}"></script>
@endpush
