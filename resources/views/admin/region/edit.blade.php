<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">Edit Region</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form class="form-horizontal" id="ajax-form" method="POST"
            action="{{ route('region.update', ['region' => $region->id]) }}" enctype="multipart/form-data" data-file="true" data-table="datatable"
           data-notification="">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <label for="region_code" class="col-md-4 col-form-label text-md-end">{{ __('Code') }}</label>
                <div class="col-md-6">
                    <input id="region_code" type="text" class="form-control @error('code') is-invalid @enderror"
                        readonly value="{{ $region->code }}" required autocomplete="code" autofocus>

                    @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="region_name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="region_name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ $region->name }}" required>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
