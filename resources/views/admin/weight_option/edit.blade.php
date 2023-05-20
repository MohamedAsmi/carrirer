<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">Edit Weight Option</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" id="ajax-form" method="POST" action="{{ route('weight-option.update',['weight_option'=>$weightOption->id]) }}"
            enctype="multipart/form-data" data-file="true" data-notification="div" data-table="weightoption">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{$weightOption->name}}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="value" class="col-md-4 col-form-label text-md-end">{{ __('Value') }}</label>
                <div class="col-md-6">
                    <input id="value" type="text" class="form-control @error('value') is-invalid @enderror"
                        name="value" value="{{$weightOption->value}}" required>

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
