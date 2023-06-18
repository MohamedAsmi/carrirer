<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">

@include('layouts.head')
@stack('css')

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @if (auth()->check())
                @include('layouts.side_bar')
            @endif
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page" {!! !auth()->check() ? "style='padding-left: 0 !important'" : '' !!}>
                <!-- Navbar -->

                @include('layouts.nav')



                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">


                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('body')
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('layouts.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <div id="modal" class="modal fade col-md-12" tabindex="-1" role="dialog" aria-hidden="true"></div>
    <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form-horizontal" id="ajax-form" method="DELETE" data-notification="">
                    <div class="modal-body">
                        <div id="message-area"></div>
                        @csrf
                        Are your sure want to delete?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-danger" data-loading-text="Deleting...">DELETE</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    @include('layouts.script')
    @stack('js')
</body>

</html>
