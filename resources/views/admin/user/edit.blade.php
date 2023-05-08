
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">Edit User</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <form class="form-horizontal" id="ajax-form" method="POST"
      action="{{route('user.store')}}"
      data-table="marks_table" enctype="multipart/form-data" data-file="true" data-notification="div">
      <div class="modal-body">
        <div id="message-area"></div>
        @csrf
        
        <div class="row mb-3">
          <div class="col mb-0">
            <label for="emailSlideTop" class="form-label">First Name</label>
            <input
              type="text"
              name="module"
              class="form-control"
              placeholder="Enter module Name"
            />
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Close
        </button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      
    </form>
      
    </div>
  </div>
  