@extends('admin.layouts.app')
@section('page-title', 'Credit History')
@section('body')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-6">
                <h4 class="fw-bold py-3 mb-4"><span class="fw-light">Credit History</h4>
            </div>
            <div class="col-6 text-right">
                <a href="javascript:void(0)" class="load-modal" title="Edit" data-url="{{ route('accredit.create') }}">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <span><i class="fa fa-plus"></i>Add Credit</span>
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
                        <table id="credits_table" class="table table-md-8" data-url="{{ route('accredit.list') }}">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Credit Added</th>
                                    <th>Credit Amount</th>
                                    <th>Source</th>
                                    <th>Credit Add By</th>
                                    <th>Credit Add To</th>
                                    <th>Note</th>
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
    <script src="{{ asset('assets/js/admin/credit.js?t=' . config('app.t')) }}"></script>
@endpush
