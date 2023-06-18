@extends('layouts.app')
@section('page-title', 'Dashboard')
@section('body')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (session('success'))
            <div class="row">
                <div class="{{ auth()->check() ? 'col-lg-12' : 'offset-2 col-lg-8' }} mb-4 order-0">
                    <div class="alert alert-success" role="alert">
                        {!! session('success') !!}
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="{{ auth()->check() ? 'col-lg-12' : 'offset-2 col-lg-8' }} mb-4 order-0">

                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Welcome
                                    {{ auth()->check() ? Auth::user()->first_name : '' }}
                                    {{ auth()->check() ? Auth::user()->last_name : '' }} ! 🎉</h5>
                                <p class="mb-4">
                                    Welcome to our courier label management system! Streamline your shipping process, track
                                    packages, and manage labels efficiently. We're here to simplify your logistics tasks.
                                    Happy shipping!
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
