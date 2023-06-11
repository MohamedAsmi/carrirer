<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl">

        <div class="mb-4 mb-md-0 pb-4">
            @if (!auth()->check())
                <div class="row align-items-center text-center">
                    <div>
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo"
                            style="display: block;
            margin-left: auto;
            margin-right: auto;
            width: 20%;padding: 10px;"
                            class="center">
                    </div>
                    <div style=" margin-left: 34px;">© 2023</div>
                </div>
            @else
                <div class="row align-items-center">

                    <div class="col-10" style=" margin-left: 34px;">© 2023</div>
                </div>
            @endif
        </div>
        <div>

        </div>
    </div>
</footer>
