<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">Create Region</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" id="ajax-form" method="POST" action="{{ route('region.store') }}" data-table="datatable"
            enctype="multipart/form-data" data-file="true" data-notification="div">
            @csrf

            <div class="row mb-3">
                <label for="region_code" class="col-md-4 col-form-label text-md-end">{{ __('Code') }}</label>
                <div class="col-md-6">
                    <input id="region_code" type="text"
                        class="form-control @error('code') is-invalid @enderror" name="code"
                        value="{{ old('code') }}" required autocomplete="code" autofocus>

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
                    <input id="region_name" type="text"
                        class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="region_description"
                    class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                <div class="col-md-6">
                    <textarea id="region_description" type="text" class="form-control @error('description') is-invalid @enderror"
                        name="description" value="{{ old('description') }}" required cols="30" rows="3"></textarea>

                    @error('region_description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create') }}
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>