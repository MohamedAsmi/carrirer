<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">Create Weight Option</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" id="ajax-form" method="POST" action="{{ route('weight-option.store') }}"
            enctype="multipart/form-data" data-file="true"data-notification="" data-table="weightoption">
            @csrf

            <div class="row mb-3">
                <label for="setting_name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="setting_name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="region_id" class="col-md-4 col-form-label text-md-end">{{ __('Region') }}</label>
                <div class="col-md-6">
                    <select name="region_id" id="region_id" class="form-control" required>
                        <option value="">Choose one</option>
                        @foreach ($regions as $region)
                            <option value="{{$region->id}}">{{$region->name}}</option>
                        @endforeach
                    </select>
                 

                    @error('region_id')
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
