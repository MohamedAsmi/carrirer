<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">Create Setting</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" id="ajax-form" method="POST"
            action="{{ route('settings.child-setting.store', ['setting' => $parent_setting->id]) }}" data-table="datatable"
            enctype="multipart/form-data" data-file="true"data-notification="">
            @csrf

            <input type="hidden" name="parent_id" value="{{ $parent_setting->id }}">
            @if ($parent_setting->application_level == 1)
                <input type="hidden" name="application_level" value="1">
            @endif

            <div class="row mb-3">
                <label for="setting_key" class="col-md-4 col-form-label text-md-end">{{ __('Key') }}</label>
                <div class="col-md-6">
                    <input id="setting_key" type="text" class="form-control @error('key') is-invalid @enderror"
                        name="key" value="{{ old('key') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="setting_value" class="col-md-4 col-form-label text-md-end">{{ __('Value') }}</label>
                <div class="col-md-6">
                    <input id="setting_value" type="text" class="form-control @error('value') is-invalid @enderror"
                        name="value" value="{{ old('value') }}" required>

                    @error('value')
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
