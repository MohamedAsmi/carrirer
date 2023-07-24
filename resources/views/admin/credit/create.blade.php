<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">Add Credit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" id="ajax-form" method="POST" action="{{ route('accredit.store') }}" data-table="credits_table"
            enctype="multipart/form-data" data-file="true"data-notification="">
            @csrf

            <div class="row mb-3">
                <label for="user_id" class="col-md-4 col-form-label text-md-end">{{ __('Select User') }}</label>
                <div class="col-md-6">
                    <select name="user_id" id="user_id"  class="form-control">
                        <option value="" hidden>Choose one</option>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                        @endforeach
                    </select>
                  

                    @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="source" class="col-md-4 col-form-label text-md-end">{{ __('Private (Only Visible to Administration)') }}</label>
                <div class="col-md-6 mt-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="source" id="source_yes" value="1" {{ old('source') == 0 ? 'checked' : '' }} required>
                        <label class="form-check-label" for="source_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="source" id="source_no" value="0" {{ old('source') == 1 ? 'checked' : '' }} required>
                        <label class="form-check-label" for="source_no">No</label>
                    </div>
                    @error('source')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="credit_amount" class="col-md-4 col-form-label text-md-end">{{ __('Credit Amount') }}</label>
                <div class="col-md-6">
                    <input id="credit_amount" type="number"
                        class="form-control @error('credit_amount') is-invalid @enderror" name="credit_amount"
                        value="{{ old('credit_amount') }}" required>

                    @error('credit_amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="details" class="col-md-4 col-form-label text-md-end">{{ __('Notes') }}</label>
                <div class="col-md-6">
                    <textarea id="details" type="text"
                        class="form-control @error('details') is-invalid @enderror" name="details"
                        value="{{ old('details') }}" required></textarea>

                    @error('details')
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
