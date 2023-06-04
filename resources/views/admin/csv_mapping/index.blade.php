@extends('admin.layouts.app')
@section('page-title', 'Regions')
@section('body')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-6">
                <h4 class="fw-bold py-3 mb-4"><span class="fw-light">CSV Mapping</h4>
            </div>
            {{-- <div class="col-6 text-right">
                <a href="javascript:void(0)" class="load-modal" title="Edit" data-url="{{ route('region.create') }}">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <span><i class="fa fa-plus"></i>Create Region</span>
                    </button>
                </a>
            </div> --}}
        </div>

        <div class="row">
            <!-- Basic Layout -->
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-body col-md-12">
                        <form class="form-horizontal" method="POST" action="{{ route('csv-mapping.upload') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="select_user"
                                    class="col-4 col-form-label form-label text-end">{{ __('Select User') }}</label>
                                <div class="col-md-6">
                                    <select id="select_user" name="user_id" class="form-control">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->first_name . ' ' . $user->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="select_user"
                                    class="col-4 col-form-label form-label text-end">{{ __('CSV File') }}</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control-file" name="csv_file">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="select_user" class="col-4 col-form-label form-label text-end">&nbsp;</label>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">Next</button>
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
    <script src="{{ asset('assets/js/admin/region.js?t=' . config('app.t')) }}"></script>
    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr['error']('{{ $error }}');
            @endforeach
        </script>
    @endif
@endpush
