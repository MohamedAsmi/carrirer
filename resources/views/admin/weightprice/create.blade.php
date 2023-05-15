<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">Create Weight price</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" id="ajax-form" method="POST" action="{{ route('weightprice.store') }}"
            enctype="multipart/form-data" data-file="true" data-notification="div" data-table="weightprice">
            @csrf

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
                <label for="weightoption_id" class="col-md-4 col-form-label text-md-end">{{ __('Weight Option') }}</label>
                <div class="col-md-6">
                    <select name="weightoption_id" id="weightoption_id" class="form-control" required>
                        <option value="">Choose one</option>
                        @foreach ($weightoptions as $weightoption)
                            <option value="{{$weightoption->id}}">{{$weightoption->name}}</option>
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
                        name="credits"  required>

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
