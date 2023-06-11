@extends('admin.layouts.app')
@section('page-title', 'Dashboard')
@section('body')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Hello! {{ auth()->check() ? Auth::user()->first_name : '' }}. Welcome to admin dashboard.
                                    {{ auth()->check() ? Auth::user()->last_name : '' }} ! 🎉</h5>
                                <p class="mb-4">
                                  Welcome to our courier label management system! Streamline your shipping process, track packages, and manage labels efficiently. We're here to simplify your logistics tasks. Happy shipping!
                                </p>


                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">
                                    <div id="current-time" style="font-size: 30px"></div>
                                    <div id="current-date" style="font-size: 30px"></div>
                                </span>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Total Revenue -->

            <!--/ Total Revenue -->
            {{-- <div class="col-8 order-3 order-md-2">
        <div class="row">
          <div class="col-3 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <i class="menu-icon tf-icons bx bx bxs-file-plus" style="color: rgba(94, 189, 226, 0.986)"></i>

                  </div>
                 
                </div>
                <span class="d-block mb-1">Programmes</span>
                <h3 class="card-title text-nowrap mb-2">{{$programmes}}</h3>
         
              </div>
            </div>
          </div>
          <div class="col-3 mb-4">
            <div class="card">
              <div class="card-body">
                
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <i class="menu-icon tf-icons bx bxs-certification" style="color: rgba(94, 189, 226, 0.986)"></i>
                  </div>
                 
                </div>
                <span class="fw-semibold d-block mb-1">Certificates</span>
                <h3 class="card-title mb-2">{{$certificates}}</h3>
               
              </div>
            </div>
          </div>
          <div class="col-3 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <i class="menu-icon tf-icons bx bxs-graduation" style="color: rgba(94, 189, 226, 0.986)"></i>

                  </div>
                  
                </div>
                <span class="fw-semibold d-block mb-1">Student</span>
                <h3 class="card-title mb-2">{{$student_count}}</h3>
               
              </div>
            </div>
          </div>
          <div class="col-3 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <i class="menu-icon tf-icons bx bxs-credit-card" style="color: rgba(94, 189, 226, 0.986)"></i>

                  </div>
                  
                </div>
                <span class="fw-semibold d-block mb-1">Payments</span>
                <h3 class="card-title mb-2">{{$payment}}</h3>
               
              </div>
            </div>
          </div>
        
          <!-- </div>
<div class="row"> -->
          
        </div>
      </div> --}}
        </div>

    </div>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>

    <script>
        window.addEventListener('load', updateCurrentDateTime);

        function updateCurrentDateTime() {
            const currentDateTime = new Date();
            const formattedTime = currentDateTime.toLocaleTimeString();
            document.getElementById('current-time').innerText = formattedTime;

            const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            const formattedDate = currentDateTime.toLocaleDateString('en-UK', options);
            document.getElementById('current-date').innerText = formattedDate;
            setTimeout(updateCurrentDateTime, 1000);
        }
    </script>
@endsection
