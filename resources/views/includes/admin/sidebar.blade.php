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
                    <a href="{{ route('dashboard') }}"
                        class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Overview</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- travel packages --}}
        <li class="nav-item">
            <a class="nav-link {{ in_array(Route::currentRouteName(), ['travel-package.create', 'travel-package.index']) ? '' : 'collapsed' }}"
                data-bs-target="#travelpackage-nav" data-bs-toggle="collapse" href="#">
                <i class='bx bx-package'></i><span>Travel Package</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="travelpackage-nav"
                class="nav-content collapse {{ in_array(Route::currentRouteName(), ['travel-package.create', 'travel-package.index']) ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('travel-package.create') }}"
                        class="{{ Route::currentRouteName() == 'travel-package.create' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Add Travel Package</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('travel-package.index') }}"
                        class="{{ Route::currentRouteName() == 'travel-package.index' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Data Travel Package</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Travel Package Nav -->

        {{-- gallery --}}
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
        </li><!-- End Tables Nav -->

        <li class="nav-heading">Transactions</li>


        {{-- order --}}
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
        </li><!-- End Tables Nav -->



        <li class="nav-heading">Role and Permission</li>

        {{-- role and permissions --}}
        <li class="nav-item">
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
        </li><!-- End Tables Nav -->

        <li class="nav-item">
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
        </li><!-- End Tables Nav -->

        <li class="nav-heading">Settings</li>

        {{-- user --}}
        <li class="nav-item">
            <a class="nav-link collapsed {{ in_array(Route::currentRouteName(), ['user.create', 'user.index']) ? '' : 'collapsed' }}"
                data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person"></i><span>User</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="user-nav"
                class="nav-content collapse {{ in_array(Route::currentRouteName(), ['user.create', 'user.index']) ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('user.create') }}"
                        class="{{ Route::currentRouteName() == 'user.create' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Add User</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.index') }}"
                        class="{{ Route::currentRouteName() == 'user.index' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Data User</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav -->

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

        <li class="nav-heading">REPORT</li>

        <li class="nav-item">
            <a class="nav-link {{ in_array(Route::currentRouteName(), ['report-transaction', 'report-travel-package']) ? '' : 'collapsed' }}"
                data-bs-target="#report-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-text"></i><span>Report</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="report-nav"
                class="nav-content collapse {{ in_array(Route::currentRouteName(), ['report-transaction', 'report-travel-package']) ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('report-transaction') }}"
                        class="{{ Route::currentRouteName() == 'report-transaction' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Transaction</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('report-travel-package') }}"
                        class="{{ Route::currentRouteName() == 'report-travel-package' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Travel Package</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Report Nav -->
        {{-- 

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="charts-chartjs.html">
                        <i class="bi bi-circle"></i><span>Chart.js</span>
                    </a>
                </li>
                <li>
                    <a href="charts-apexcharts.html">
                        <i class="bi bi-circle"></i><span>ApexCharts</span>
                    </a>
                </li>
                <li>
                    <a href="charts-echarts.html">
                        <i class="bi bi-circle"></i><span>ECharts</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Charts Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="icons-bootstrap.html">
                        <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
                    </a>
                </li>
                <li>
                    <a href="icons-remix.html">
                        <i class="bi bi-circle"></i><span>Remix Icons</span>
                    </a>
                </li>
                <li>
                    <a href="icons-boxicons.html">
                        <i class="bi bi-circle"></i><span>Boxicons</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Icons Nav --> --}}
        {{-- 
        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>F.A.Q</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-contact.html">
                <i class="bi bi-envelope"></i>
                <span>Contact</span>
            </a>
        </li><!-- End Contact Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-register.html">
                <i class="bi bi-card-list"></i>
                <span>Register</span>
            </a>
        </li><!-- End Register Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-login.html">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Login</span>
            </a>
        </li><!-- End Login Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-error-404.html">
                <i class="bi bi-dash-circle"></i>
                <span>Error 404</span>
            </a>
        </li><!-- End Error 404 Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-blank.html">
                <i class="bi bi-file-earmark"></i>
                <span>Blank</span>
            </a>
        </li><!-- End Blank Page Nav --> --}}

    </ul>

</aside>
