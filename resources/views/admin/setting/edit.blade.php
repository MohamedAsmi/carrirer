<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">Edit Setting</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form class="form-horizontal" id="ajax-form" method="POST" action="{{ route('setting.update', $setting->id) }}"
            enctype="multipart/form-data" data-file="true"data-notification="" data-table="datatable">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label for="setting_key" class="col-md-4 col-form-label text-md-end">{{ __('Key') }}</label>
                <div class="col-md-6">
                    <input id="setting_key" type="text" class="form-control @error('key') is-invalid @enderror"
                        name="key" value="{{ old('key') ?? $setting->key }}" required autocomplete="key"
                        autofocus>

                    @error('key')
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
                        name="value" value="{{ old('value') ?? $setting->value }}" required>

                    @error('value')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="setting_value" class="col-md-4 col-form-label text-md-end"></label>
                <div class="col-md-6">
                    <div class="form-check">
                        <input type="checkbox" {{ ($setting->application_level == 1) ? 'checked' : '' }} class="form-check-input" id="app_setting" name="application_level"
                            value="1">
                        <label class="form-check-label" for="app_setting">Application setting</label>
                    </div>
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
