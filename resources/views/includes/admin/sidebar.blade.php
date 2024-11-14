<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        {{-- <li class="nav-item">
            <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav --> --}}
        {{-- dashborad --}}
        <li class="nav-item">
            <a class="nav-link {{ in_array(Route::currentRouteName(), ['dashboard']) ? '' : 'collapsed' }}"
                data-bs-target="#dashboard-nav" data-bs-toggle="collapse" href="#">
                <i class='bx bx-package'></i><span>Dashboard</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="dashboard-nav"
                class="nav-content collapse {{ in_array(Route::currentRouteName(), ['dashboard']) ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('dashboard', ['role' => Auth::user()->getRoleNames()->first()]) }}"
                        class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Overview</span>
                    </a>
                </li>
            </ul>
        </li>

        @if (Auth::user()->can('view package') && Auth::user()->can('view gallery'))
            <li class="nav-heading">Package</li>
        @endif

        {{-- travel packages --}}
        @can('view package')
            <li class="nav-item">
                <a class="nav-link {{ in_array(Route::currentRouteName(), ['travel-package.create', 'travel-package.index']) ? '' : 'collapsed' }}"
                    data-bs-target="#travelpackage-nav" data-bs-toggle="collapse" href="#">
                    <i class='bx bx-package'></i><span>Travel Package</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="travelpackage-nav"
                    class="nav-content collapse {{ in_array(Route::currentRouteName(), ['travel-package.create', 'travel-package.index']) ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    @can('create package')
                        <li>
                            <a href="{{ route('travel-package.create') }}"
                                class="{{ Route::currentRouteName() == 'travel-package.create' ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Add Travel Package</span>
                            </a>
                        </li>
                    @endcan
                    @can('view package')
                        <li>
                            <a href="{{ route('travel-package.index') }}"
                                class="{{ Route::currentRouteName() == 'travel-package.index' ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Data Travel Package</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li><!-- End Travel Package Nav -->
        @endcan

        {{-- gallery --}}
        @can('view gallery')
            <li class="nav-item">
                <a class="nav-link collapsed {{ in_array(Route::currentRouteName(), ['gallery.create', 'gallery.index']) ? '' : 'collapsed' }}"
                    data-bs-target="#gallery-nav" data-bs-toggle="collapse" href="#">
                    <i class='bx bx-photo-album'></i><span>Gallery</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="gallery-nav"
                    class="nav-content collapse  {{ in_array(Route::currentRouteName(), ['gallery.create', 'gallery.index']) ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('gallery.create') }}"
                            class="{{ Route::currentRouteName() == 'gallery.create' ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Add Gallery</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gallery.index') }}"
                            class="{{ Route::currentRouteName() == 'gallery.index' ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Data Gallery</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        <!-- End Tables Nav -->

        @if (Auth::user()->can('view transaction'))
            <li class="nav-heading">Transactions</li>
        @endif

        {{-- order --}}
        @can('view transaction')
            <li class="nav-item">
                <a class="nav-link collapsed {{ in_array(Route::currentRouteName(), ['transaction.index']) ? '' : 'collapsed' }}"
                    data-bs-target="#transaction-nav" data-bs-toggle="collapse" href="#">
                    <i class="bx bx-money"></i><span>Order</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="transaction-nav"
                    class="nav-content collapse {{ in_array(Route::currentRouteName(), ['transaction.index']) ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="{{ route('transaction.index') }}"
                            class="{{ Route::currentRouteName() == 'transaction.index' ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Data Order</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        <!-- End Tables Nav -->


        @if (Auth::user()->can('view role') || Auth::user()->can('view permission'))
            <li class="nav-heading">Role and Permission</li>
        @endif

        {{-- role and permissions --}}
        <li class="nav-item">
            @can('view role')
                <a class="nav-link collapsed {{ in_array(Route::currentRouteName(), ['roles.index']) ? '' : 'collapsed' }}"
                    data-bs-target="#roles-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i><span>Roles</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="roles-nav"
                    class="nav-content collapse {{ in_array(Route::currentRouteName(), ['roles.index']) ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="{{ route('roles.index') }}"
                            class="{{ Route::currentRouteName() == 'roles.index' ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Data Roles</span>
                        </a>
                    </li>
                </ul>
            @endcan
        </li><!-- End Tables Nav -->

        <li class="nav-item">
            @can('view permission')
                <a class="nav-link collapsed {{ in_array(Route::currentRouteName(), ['permissions.index']) ? '' : 'collapsed' }}"
                    data-bs-target="#permissions-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i><span>Permissions</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="permissions-nav"
                    class="nav-content collapse {{ in_array(Route::currentRouteName(), ['permissions.index']) ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">

                    <li>
                        <a href="{{ route('permissions.index') }}"
                            class="{{ Route::currentRouteName() == 'permissions.index' ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Data Permissions</span>
                        </a>
                    </li>
                </ul>
            @endcan
        </li><!-- End Tables Nav -->

        @if (Auth::user()->can('view user') || Auth::user()->can('view carousel'))
            <li class="nav-heading">Settings</li>
        @endif
        {{-- user --}}
        @can('view user')
            <li class="nav-item">
                <a class="nav-link collapsed {{ in_array(Route::currentRouteName(), ['user.create', 'user.index']) ? '' : 'collapsed' }}"
                    data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i><span>User</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="user-nav"
                    class="nav-content collapse {{ in_array(Route::currentRouteName(), ['user.create', 'user.index']) ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    @can('create user')
                        <li>
                            <a href="{{ route('user.create') }}"
                                class="{{ Route::currentRouteName() == 'user.create' ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Add User</span>
                            </a>
                        </li>
                    @endcan

                    @can('view user')
                        <li>
                            <a href="{{ route('user.index') }}"
                                class="{{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Data User</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <!-- End Tables Nav -->

        @can('view carousel')
            <li class="nav-item">
                <a class="nav-link collapsed {{ in_array(Route::currentRouteName(), ['carousels.index']) ? '' : 'collapsed' }}"
                    data-bs-target="#carousel-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i><span>Carousels</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="carousel-nav"
                    class="nav-content collapse {{ in_array(Route::currentRouteName(), ['carousels.index']) ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    {{-- <li>
                    <a href="{{ route('user.create') }}">
                        <i class="bi bi-circle"></i><span>Add User</span>
                    </a>
                </li> --}}
                    <li>
                        <a href="{{ route('carousels.index') }}"
                            class="{{ Route::currentRouteName() == 'carousels.index' ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Data Carousels</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        @if (Auth::user()->can('view report transaction') || Auth::user()->can('view report package'))
            <li class="nav-heading">REPORT</li>
        @endif

        <li class="nav-item">
            @if (Auth::user()->can('view report transaction') || Auth::user()->can('view report package'))
                <a class="nav-link {{ in_array(Route::currentRouteName(), ['report-transaction', 'report-travel-package']) ? '' : 'collapsed' }}"
                    data-bs-target="#report-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-file-earmark-text"></i><span>Report</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
            @endif
            <ul id="report-nav"
                class="nav-content collapse {{ in_array(Route::currentRouteName(), ['report-transaction', 'report-travel-package']) ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                @can('view report transaction')
                    <li>
                        <a href="{{ route('report-transaction') }}"
                            class="{{ Route::currentRouteName() == 'report-transaction' ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Transaction</span>
                        </a>
                    </li>
                @endcan

                @can('view report package')
                    <li>
                        <a href="{{ route('report-travel-package') }}"
                            class="{{ Route::currentRouteName() == 'report-travel-package' ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Travel Package</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li><!-- End Report Nav -->


    </ul>

</aside>
