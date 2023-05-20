<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">Edit Setting</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form class="form-horizontal" id="ajax-form" method="POST"
            action="{{ route('settings.child-setting.update', ['setting' => $setting->parent_id, 'child' => $setting->id]) }}"
            enctype="multipart/form-data" data-file="true"data-notification="" data-table="datatable">
            @csrf
            @method('PUT')

            <input type="hidden" name="parent_id" value="{{ $parent_setting->id }}">
            <div class="row mb-3">
                <label for="setting_name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="setting_name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') ?? $setting->name }}" required autocomplete="name"
                        autofocus>

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
                        name="value" value="{{ old('value') ?? $setting->value }}" required>

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
                        {{ __('Update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
