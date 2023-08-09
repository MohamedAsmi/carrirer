<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">Add Credit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal"  method="POST" action="{{ route('credit.store') }}"
            data-table="labels_table" enctype="multipart/form-data" data-file="true" data-notification="">
            @csrf

      
            <div class="row mb-3">
                <label for="rigion" class="col-md-4 col-form-label text-md-end">{{ __('Add Credits') }}</label>

                <div class="col-md-6">
                    <select name="amount" id="amount" class="form-control">
                        <option value="" disabled>Choose One</option>
                        <option value="50" >50 Credits For 50US$</option>
                        <option value="100" >100 Credits For 100US$</option>
                        <option value="150" >50 Credits For 150US$</option>
                        <option value="200" >50 Credits For 200US$</option>
                        <option value="250" >50 Credits For 250US$</option>
                        <option value="300" >50 Credits For 300US$</option>
                    </select>


                    @error('rigion')
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
