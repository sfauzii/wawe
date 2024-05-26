
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#travelpackage-nav" data-bs-toggle="collapse" href="#">
                <i class='bx bx-package'></i><span>Travel Package</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="travelpackage-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('travel-package.create') }}">
                        <i class="bi bi-circle"></i><span>Add Travel Package</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('travel-package.index') }}">
                        <i class="bi bi-circle"></i><span>Data Travel Package</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Tables Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#gallery-nav" data-bs-toggle="collapse" href="#">
                <i class='bx bx-photo-album'></i><span>Gallery</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="gallery-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('gallery.create') }}">
                        <i class="bi bi-circle"></i><span>Add Gallery</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('gallery.index') }}">
                        <i class="bi bi-circle"></i><span>Data Gallery</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#transaction-nav" data-bs-toggle="collapse" href="#">
                <i class="bx bx-money"></i><span>Transaction</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="transaction-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                {{-- <li>
                    <a href="{{ route('transaction.create') }}">
                        <i class="bi bi-circle"></i><span>Add Transaction</span>
                    </a>
                </li> --}}
                <li>
                    <a href="{{ route('transaction.index') }}">
                        <i class="bi bi-circle"></i><span>Data Transaction</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person"></i><span>User</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="user-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('user.create') }}">
                        <i class="bi bi-circle"></i><span>Add User</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.index') }}">
                        <i class="bi bi-circle"></i><span>Data User</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav -->

        <li class="nav-heading">REPORT</li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#report-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-file-earmark-text"></i><span>Report</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="report-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('report-transaction') }}">
                        <i class="bi bi-circle"></i><span>Transaction</span>
                    </a>
                </li>
            </ul>
            <ul id="report-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('report-travel-package') }}">
                        <i class="bi bi-circle"></i><span>Travel Package</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav -->
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
