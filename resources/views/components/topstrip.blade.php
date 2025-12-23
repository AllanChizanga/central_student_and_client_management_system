<!-- App Topstrip: Admin Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark app-topstrip py-3 px-3 w-100" style="background-color: #232c38;">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/images/logos/logo.png') }}" alt="Logo" width="80">
        </a>
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavBar" aria-controls="adminNavBar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Show sidebartoggler on small screens and below -->
        <a class="nav-link sidebartoggler d-lg-none ms-2" id="headerCollapseMobile" href="javascript:void(0)">
            <i class="ti ti-layout-sidebar-right-expand"></i>
        </a>
        <div class="collapse navbar-collapse justify-content-end" id="adminNavBar">
            <ul class="navbar-nav align-items-lg-center gap-lg-3 fw-semibold">
                <!-- Show sidebartoggler only on lg and above (hidden on small screens) -->
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
                        <i class="ti ti-layout-sidebar-right-expand"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('student') }}">
                        <i class="ti ti-users me-1"></i>
                        Students
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <i class="ti ti-clipboard-list me-1"></i>
                        Enrollments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <i class="ti ti-book me-1"></i>
                        Courses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <i class="ti ti-user-check me-1"></i>
                        Alumnis
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <i class="ti ti-award me-1"></i>
                        Success Stories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">
                        <i class="ti ti-briefcase me-1"></i>
                        Portfolio
                    </a>
                </li>
                <!-- Logout as a nav link, using a form and button for POST -->
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-white fw-semibold d-flex align-items-center p-0" style="text-decoration: none;">
                            <i class="ti ti-logout me-1"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
