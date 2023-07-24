<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <div class="app-brand demo">

        <span class="app-brand-logo demo text-end">

            <div style="height:50px;width: 220px;border:none;">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="max-height: 100%;">
            </div>

        </span>




    </div>
    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 pt-4">
        @if (!request()->is('admin/*'))
            <li class="menu-item {{ Route::is('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Home</div>
                </a>
            </li>
            @if (auth()->user()->isAdmin())
                <li class="menu-item {{ Route::is('admin.dashboard.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link text-primary">
                        <i class="menu-icon tf-icons bx bx-user-pin"></i>
                        <div data-i18n="Analytics">Admin</div>
                    </a>
                </li>
            @endif
        @endif

        @if (auth()->user()->isAdmin())
            @if (request()->is('admin/*'))
                <li class="menu-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Dashboard</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('user') ? 'active' : '' }}">
                    <a href="{{ route('user') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div data-i18n="Analytics">Users</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('region.*') ? 'active' : '' }}">
                    <a href="{{ route('region.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-map-pin"></i>
                        <div data-i18n="Analytics">Regions</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('weight-option.*') ? 'active' : '' }}">
                    <a href="{{ route('weight-option.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-package"></i>
                        <div data-i18n="Analytics">Weight Option</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('weight-price.*') ? 'active' : '' }}">
                    <a href="{{ route('weight-price.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-package"></i>
                        <div data-i18n="Analytics">Weight Price</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('user-weight-price.*') ? 'active' : '' }}">
                    <a href="{{ route('user-weight-price.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-package"></i>
                        <div data-i18n="Analytics">User Weight Price</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('csv-mapping.*') ? 'active' : '' }}">
                    <a href="{{ route('csv-mapping.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-sitemap"></i>
                        <div>CSV Mapping</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('admincredit.*') ? 'active' : '' }}">
                    <a href="{{route('accredit.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-history"></i>
                        <div data-i18n="Analytics">Credit History</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('setting.*') ? 'active' : '' }}">
                    <a href="{{ route('setting.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-cog"></i>
                        <div data-i18n="Analytics">Settings</div>
                    </a>
                </li>
                <li class="menu-item ">
                    <a href="{{ route('home') }}" class="menu-link text-danger">
                        <i class="menu-icon tf-icons bx bx-exit"></i>
                        <div data-i18n="Analytics">Exit Admin</div>
                    </a>
                </li>
            @endif
        @endif





    </ul>
</aside>
