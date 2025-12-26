<!-- App Topstrip: Admin Navigation -->
<nav class="navbar navbar-expand-lg app-topstrip app-bg-elevated py-3 px-3 w-100">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <a class="navbar-brand d-flex align-items-center app-text-primary" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/images/logos/logo.png') }}" alt="Logo" width="80">
        </a>
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavBar" aria-controls="adminNavBar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="adminNavBar">
            <ul class="navbar-nav align-items-lg-center gap-lg-3 fw-semibold">
                <!-- Show sidebartoggler only on lg and above (hidden on small screens) -->
                <li class="nav-item d-none d-lg-block app-text-primary">
                    <a class="nav-link sidebartoggler app-text-primary" id="headerCollapse" href="javascript:void(0)"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Toggle sidebar">
                        <i class="ti ti-layout-sidebar-right-expand app-text-primary"></i>
                    </a>
                </li>
                <!-- Show sidebartoggler only when device width is 1200px or less -->
                <li class="nav-item app-text-primary d-lg-none">
                    <a class="nav-link sidebartoggler ms-2 app-text-primary" id="headerCollapseMobile" href="javascript:void(0)" 
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Toggle sidebar">
                        <i class="ti ti-layout-sidebar-right-expand app-text-primary"></i>
                    </a>
                </li>
                <li class="nav-item app-text-primary">
                    <a class="nav-link app-text-primary" href="#"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="View recent notifications">
                        <i class="ti ti-bell me-1 app-text-primary"></i>
                        <span class="app-text-primary">Notifications</span>
                    </a>
                </li>
                <li class="nav-item app-text-primary">
                    <a class="nav-link app-text-primary" href="#"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Post new alumnis">
                        <i class="ti ti-user-check me-1 app-text-primary"></i>
                        <span class="app-text-primary">Alumnis</span>
                    </a>
                </li>
                <li class="nav-item app-text-primary">
                    <a class="nav-link app-text-primary" href="#"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Post alumni success story">
                        <i class="ti ti-award me-1 app-text-primary"></i>
                        <span class="app-text-primary">Success Stories</span>
                    </a>
                </li>
                <li class="nav-item app-text-primary">
                    <a class="nav-link app-text-primary" href="#"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Manage portfolios and student projects">
                        <i class="ti ti-briefcase me-1 app-text-primary"></i>
                        <span class="app-text-primary">Portfolio</span>
                    </a>
                </li>
                <li class="nav-item app-text-primary">
                    <a class="nav-link app-text-primary" href="#"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Adjust general application settings">
                        <i class="ti ti-settings me-1 app-text-primary"></i>
                        <span class="app-text-primary">Settings</span>
                    </a>
                </li>
                <!-- Logout as a nav link, using a form and button for POST -->
                <li class="nav-item app-text-primary">
                    <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link app-text-primary fw-semibold d-flex align-items-center p-0"
                            style="text-decoration: none;"
                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Logout of admin dashboard">
                            <i class="ti ti-logout me-1 app-text-primary"></i> <span class="app-text-primary">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
