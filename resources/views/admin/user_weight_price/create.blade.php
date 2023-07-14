<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">Create Weight price</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" id="ajax-form" method="POST" action="{{ route('user-weight-price.store') }}"
            enctype="multipart/form-data" data-file="true"data-notification="" data-table="user-weight-price">
            @csrf
            <div class="row mb-3">
                <label for="user_id" class="col-md-4 col-form-label text-md-end">{{ __('User') }}</label>
                <div class="col-md-6">
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Choose one</option>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
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
                <label for="weight_option_id" class="col-md-4 col-form-label text-md-end">{{ __('Weight Option') }}</label>
                <div class="col-md-6">
                    <select name="weight_option_id" id="weight_option_id" class="form-control" required>
                        <option value="">Choose one</option>
                        @foreach ($weightOptions as $weightoption)
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
                <label for="credit" class="col-md-4 col-form-label text-md-end">{{ __('credit') }}</label>
                <div class="col-md-6">
                    <input id="credit" type="text" class="form-control @error('credit') is-invalid @enderror"
                        name="credit"  required>

                    @error('credit')
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
