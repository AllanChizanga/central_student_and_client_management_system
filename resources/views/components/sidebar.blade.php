<!-- Sidebar Start -->
<aside class="left-sidebar mt-2 app-bg-elevated pb-4 shadow" style="min-height: 100vh; box-shadow: 0 0 24px 0 rgba(0,0,0,0.15) !important; border-right: none !important;">
    <!-- Add white space on top -->
    <div class="pt-3"></div>
    <!-- Sidebar navigation with scroll effect using Tailwind and overflow-auto and custom scrollbar -->
    <nav class="sidebar-nav overflow-auto custom-scrollbar" style="max-height: calc(70vh - 2rem);">
        <ul id="sidebarnav" class="pb-8">
            <li class="sidebar-item app-text-primary">
                <a class="sidebar-link app-text-primary" 
                   href="{{ route('dashboard') }}" 
                   data-bs-toggle="tooltip" 
                   data-bs-placement="right" 
                   title="View dashboard overview, stats, and recent activity">
                    <i class="ti ti-layout-grid app-text-primary"></i>
                    <span class="hide-menu app-text-primary">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item app-text-primary">
                <a class="sidebar-link app-text-primary" 
                   href="{{ route('student') }}" 
                   data-bs-toggle="tooltip" 
                   data-bs-placement="right" 
                   title="Browse, create, or manage student records">
                    <i class="ti ti-user app-text-primary"></i>
                    <span class="hide-menu app-text-primary">Students</span>
                </a>
            </li>
            <li class="sidebar-item app-text-primary">
                <a class="sidebar-link app-text-primary" 
                   href="{{ route('course') }}"
                   data-bs-toggle="tooltip" 
                   data-bs-placement="right" 
                   title="View and manage available courses">
                    <i class="ti ti-book app-text-primary"></i>
                    <span class="hide-menu app-text-primary">Courses</span>
                </a>
            </li>
            <li class="sidebar-item app-text-primary">
                <a class="sidebar-link app-text-primary"
                   href="{{ route('intake') }}"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="View and manage course intakes">
                    <i class="ti ti-calendar-event app-text-primary"></i>
                    <span class="hide-menu app-text-primary">Intakes</span>
                </a>
            </li>
            <li class="sidebar-item app-text-primary">
                <a class="sidebar-link app-text-primary"
                   href="#"
                   data-bs-toggle="tooltip" 
                   data-bs-placement="right" 
                   title="View and manage course enrollments">
                    <i class="ti ti-clipboard-list app-text-primary"></i>
                    <span class="hide-menu app-text-primary">Enrollments</span>
                </a>
            </li>
            <li class="sidebar-item app-text-primary">
                <a class="sidebar-link app-text-primary"
                   href="#"
                   data-bs-toggle="tooltip" 
                   data-bs-placement="right"
                   title="View and manage student and client payments">
                    <i class="ti ti-credit-card app-text-primary"></i>
                    <span class="hide-menu app-text-primary">Payments</span>
                </a>
            </li>
            <li class="sidebar-item app-text-primary">
                <a class="sidebar-link app-text-primary"
                   href="#"
                   data-bs-toggle="tooltip" 
                   data-bs-placement="right"
                   title="Browse and manage client accounts">
                    <i class="ti ti-user-circle app-text-primary"></i>
                    <span class="hide-menu app-text-primary">Clients</span>
                </a>
            </li>
            <li class="sidebar-item app-text-primary">
                <a class="sidebar-link app-text-primary"
                   href="#"
                   data-bs-toggle="tooltip" 
                   data-bs-placement="right"
                   title="Manage or view project details and status">
                    <i class="ti ti-briefcase app-text-primary"></i>
                    <span class="hide-menu app-text-primary">Projects</span>
                </a>
            </li>
            <li class="sidebar-item app-text-primary">
                <a class="sidebar-link app-text-primary"
                   href="#"
                   data-bs-toggle="tooltip" 
                   data-bs-placement="right"
                   title="View analytics and generate reports">
                    <i class="ti ti-file-analytics app-text-primary"></i>
                    <span class="hide-menu app-text-primary">Reports</span>
                </a>
            </li>
            <li class="sidebar-item app-text-primary">
                <a class="sidebar-link app-text-primary"
                   href="#"
                   data-bs-toggle="tooltip" 
                   data-bs-placement="right"
                   title="Get AI-generated feedback for assignments or work">
                    <i class="ti ti-brain app-text-primary"></i>
                    <span class="hide-menu app-text-primary">Ai feedback</span>
                </a>
            </li>
            <li class="sidebar-item app-text-primary">
                <a class="sidebar-link app-text-primary"
                   href="#"
                   data-bs-toggle="tooltip" 
                   data-bs-placement="right"
                   title="View and manage application users">
                    <i class="ti ti-users app-text-primary"></i>
                    <span class="hide-menu app-text-primary">Users</span>
                </a>
            </li>
            <li class="sidebar-item app-text-primary">
                <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="sidebar-link btn btn-link app-text-primary fw-semibold d-flex align-items-center p-0"
                        style="text-decoration: none;"
                        data-bs-toggle="tooltip" data-bs-placement="right" title="Logout of admin dashboard">
                        <i class="ti ti-logout me-1 app-text-primary"></i>
                        <span class="hide-menu app-text-primary">Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</aside>
<!-- Sidebar End -->
