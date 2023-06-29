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
            <li class="menu-item {{ (request()->is('marketplace/*')) ? 'active open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class='menu-icon tf-icons bx bx-store-alt'></i>
                    <div data-i18n="User interface">Marketplace</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ Route::is('marketplace.config.index') ? 'active' : '' }}">
                        <a href="{{ route('marketplace.config.index') }}" class="menu-link">
                            <div data-i18n="Accordion">Configurations</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link">
                            <div data-i18n="Accordion">Orders</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link">
                            <div data-i18n="Accordion">Labels</div>
                        </a>
                    </li>
                </ul>
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
    </ul>
</aside>
