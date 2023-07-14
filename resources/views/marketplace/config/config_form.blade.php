<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">{{ $marketplace->name }} Configuration</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal add_marketplace_config_form" id="ajax-form" method="POST"
                action="{{ route('marketplace.config.update') }}" enctype="multipart/form-data"
                data-file="true"data-notification="" data-table="marketplace_config">
                @csrf
                @method('PUT')

                <input type="hidden" name="marketplace" value="{{ $marketplace->id }}" />
                @foreach ($marketplaceUserSettings as $setting)
                    <div class="row mb-3">
                        <label for="field_{{ $setting->setting_id }}"
                            class="col-md-4 col-form-label text-md-end">{{ __($setting->setting_desc) }}</label>
                        <div class="col-md-6">
                            <input name="setting_val[]" value="{{ $setting->setting_value }}"
                                id="field_{{ $setting->setting_id }}" class="form-control"
                                placeholder="{{ $setting->options['placeholder'] ?? '' }}" />
                            @if (isset($setting->options['description']))
                                <div class="form-text">{{ $setting->options['description'] }}</div>
                            @endif
                        </div>
                        <input type="hidden" name="setting_id[]" value="{{ $setting->setting_id }}">
                        <input type="hidden" name="setting_parent_id[]" value="{{ $setting->setting_parent_id }}">
                    </div>
                @endforeach

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
