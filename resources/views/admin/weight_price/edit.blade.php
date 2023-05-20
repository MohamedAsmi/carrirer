<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">Edit Weight price</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" id="ajax-form" method="POST"
            action="{{ route('weight-price.update', ['weight_price' => $weightPrice->id]) }}" enctype="multipart/form-data"
            data-file="true" data-notification="div" data-table="weightprice">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label for="setting_name" class="col-md-4 col-form-label text-md-end">{{ __('Region') }}</label>
                <div class="col-md-6">
                    <select name="region_id" id="region_id" class="form-control" required>
                        <option value="">Choose one</option>
                        @foreach ($regions as $regions)
                            <option value="{{ $regions->id }}" @if ($regions->id == $weightPrice->region_id) selected @endif>
                                {{ $regions->name }}</option>
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
                <label for="setting_name" class="col-md-4 col-form-label text-md-end">{{ __('Weight Option') }}</label>
                <div class="col-md-6">
                    <select name="weightoption_id" id="weightoption_id" class="form-control" required>
                        <option value="">Choose one</option>
                        @foreach ($weightOptions as $weightoption)
                            <option value="{{ $weightoption->id }}" @if ($weightoption->id == $weightPrice->weight_option_id) selected @endif>
                                {{ $weightoption->name }}</option>
                        @endforeach
                    </select>


                    @error('weightoption_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="credits" class="col-md-4 col-form-label text-md-end">{{ __('Credits') }}</label>
                <div class="col-md-6">
                    <input id="credits" type="text" class="form-control @error('credits') is-invalid @enderror"
                        value="{{ $weightPrice->credits }}" name="credits" required>

                    @error('credits')
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
