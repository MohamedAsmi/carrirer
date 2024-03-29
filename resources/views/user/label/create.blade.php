<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">Create Labels</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" id="ajax-form" method="POST" action="{{ route('label.store') }}"
            data-table="labels_table" enctype="multipart/form-data" data-file="true" data-notification="">
            @csrf

            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Title') }} <span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <select name="title" id="title" class="form-control">
                        <option value="Mr">Mr.</option>
                        <option value="Mrs">Mrs.</option>
                        <option value="Miss">Miss.</option>
                    </select>


                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }} <span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="mobile" class="col-md-4 col-form-label text-md-end">{{ __('mobile') }} <span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror"
                        name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">

                    @error('mobile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }} <span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="refrence" class="col-md-4 col-form-label text-md-end">{{ __('Refrence') }}</label>

                <div class="col-md-6">
                    <input id="refrence" type="text" class="form-control @error('refrence') is-invalid @enderror"
                        name="refrence" value="{{ old('refrence') }}" autocomplete="refrence">

                    @error('refrence')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="address1" class="col-md-4 col-form-label text-md-end">{{ __('Address 1') }} <span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <input id="address1" type="text" class="form-control @error('address1') is-invalid @enderror"
                        name="address1" value="{{ old('address1') }}" required autocomplete="address1">

                    @error('address1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="address2" class="col-md-4 col-form-label text-md-end">{{ __('Address 2') }}</label>

                <div class="col-md-6">
                    <input id="address2" type="text" class="form-control @error('address2') is-invalid @enderror"
                        name="address2" value="{{ old('address2') }}"  autocomplete="address2">

                    @error('address2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="address3" class="col-md-4 col-form-label text-md-end">{{ __('Address 3') }}</label>

                <div class="col-md-6">
                    <input id="address3" type="text" class="form-control @error('address3') is-invalid @enderror"
                        name="address3" value="{{ old('address3') }}"  autocomplete="address3">

                    @error('address3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="street" class="col-md-4 col-form-label text-md-end">{{ __('street') }} <span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <input id="street" type="text" class="form-control @error('street') is-invalid @enderror"
                        name="street" value="{{ old('street') }}" required autocomplete="street">

                    @error('street')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="postcode" class="col-md-4 col-form-label text-md-end">{{ __('postcode') }} <span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror"
                        name="postcode" value="{{ old('postcode') }}" required autocomplete="postcode">

                    @error('postcode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="city" class="col-md-4 col-form-label text-md-end">{{ __('city') }} <span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                        value="{{ old('city') }}" required autocomplete="city">

                    @error('city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="rigion" class="col-md-4 col-form-label text-md-end">{{ __('rigion') }} <span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <select name="rigion" id="rigion" class="form-control">
                        <option value="">Choose One</option>
                        @foreach ($regions as $regions)
                        <option value="{{$regions->id}}">{{$regions->name}}</option>
                        @endforeach

                    </select>
                    <div id="loader" style="display: none;">Loading...</div>

                    @error('rigion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="service_id" class="col-md-4 col-form-label text-md-end">{{ __('service_id type') }} <span class="text-danger">*</span></label>

                <div class="col-md-6">
                    <select name="service_id" id="service_id" class="form-control">
                        <option value="">Choose One</option>
                    </select>
                    
                    @error('service_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
<script>
    $(document).on('change', '#rigion', function () {
    var dropdown = $(this);
    var loader = $('#loader');

    // Disable the dropdown while loading data
    dropdown.prop('disabled', true);

    // Show the loader inside the dropdown
    loader.show();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var selectedValue = dropdown.val();

    $.ajax({
        url: '{{ route("dropdown.values") }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            selectedValue: selectedValue
        },
        success: function (response) {
            // Hide the loader in the success callback
            loader.hide();

            // Enable the dropdown and update its options
            dropdown.prop('disabled', false);
            $('#service_id').empty();
            $('#service_id').append(response);
        },
        error: function () {
            // Hide the loader in case of an error (optional)
            loader.hide();

            // Enable the dropdown in case of an error
            dropdown.prop('disabled', false);

            // Handle the error if needed
        }
    });
});
</script>