<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">Create Labels</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" id="ajax-form" method="POST" action="{{ route('batch.store') }}"
            data-table="labels_table" enctype="multipart/form-data" data-file="true" data-notification="">
            @csrf

      
            <div class="row mb-3">
                <label for="rigion" class="col-md-4 col-form-label text-md-end">{{ __('Service Type') }}</label>

                <div class="col-md-6">
                    <select name="rigion" id="rigion" class="form-control">
                        @foreach ($settings as $setting)
                        <option value="{{$setting->id}}">{{$setting->name}}</option>
                        @endforeach

                    </select>


                    @error('rigion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="service_id" class="col-md-4 col-form-label text-md-end">{{ __('Csv To Upload') }}</label>

                <div class="col-md-6">
                   
                    <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file"
                        value="{{ old('file') }}" required autocomplete="file" autofocus>

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
    $(document).on('click','#rigion',function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var selectedValue = $(this).val();
        $.ajax({
            url: '{{ route("dropdown.values") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                selectedValue: selectedValue
            },
            success: function(response) {
                var services = $('#service');
                services.empty();

                if (response.length > 0) {
                    $.each(response, function(index, option) {
                        services.append('<option value="' + option.value + '">' + option.label + '</option>');
                    });
                }
            }
        });
    });
</script>