@extends('layouts.app')
@section('page-title', 'Tracking Parcel')
@section('body')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-6">
                <h4 class="fw-bold py-3 mb-4"><span class="fw-light">Tracking Parcel</h4>
            </div>
            {{-- <div class="col-6 text-right">
                <a href="javascript:void(0)" class="load-modal" title="Edit" data-url="{{ route('location.add') }}">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <span><i class="fa fa-plus"></i>Create New</span>
                    </button> </a>
            </div> --}}
        </div>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body col-md-12">
                        <form id="locations_tabley">
                            <div class="row">
                              <div class="form-group col-md-6">
                                <label for="inputEmail4">Tracking Ref #:</label>
                                <input type="text" id="input1" name="input1" class="form-control">
                              </div>
                            </div>
                          
                        </form>
                        <table id="locations_table" class="table table-md-8" data-url="{{ route('location.list') }}">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Description</th>
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
    <script src="{{ asset('assets/js/user/location.js?t=' . config('app.t')) }}"></script>
@endpush
