@extends('admin.layouts.app')
@section('page-title', 'User')
@section('body')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users</h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Users</h5>
            <h5 class="mb-0">
 
                <a href="javascript:void(0)" class="load-modal" title="Edit"
                data-url="{{route('user.add')}}">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <span><i class="fa fa-plus"> Add User</i></span> 
            </button> </a>
            </h5>

          </div>
          <div class="card-body col-md-12">
            
            <table id="user_table" class="table table-md-8" data-url="{{route('user.list')}}">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Status</th>
                        <th>Setting List</th>
                        <th>Action</th>
                       
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
          </div>
        </div>
      </div>
      
    </div>
  </div>

@endsection

@push('js')
<script src="{{ asset('assets/js/admin/user.js?t=' . config('app.t')) }}"></script>
@endpush