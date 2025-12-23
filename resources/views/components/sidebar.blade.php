<!-- Sidebar Start -->
<aside class="left-sidebar mt-2" style="min-height: 100vh; background-color: #e5f0fa;">
    <!-- Add white space on top -->
    <div class="pt-3"></div>
    <!-- Sidebar navigation with scroll effect using Tailwind and overflow-auto -->
    <nav class="sidebar-nav overflow-auto" style="max-height: calc(100vh - 2rem);">
        <ul id="sidebarnav" class="pb-4">
            <li class="sidebar-item">
                <a class="sidebar-link">
                    <i class="ti ti-layout-grid"></i>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('student') }}">
                    <i class="ti ti-user"></i>
                    <span class="hide-menu">Students</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="ti ti-book"></i>
                    <span class="hide-menu">Courses</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="ti ti-clipboard-list"></i>
                    <span class="hide-menu">Enrollments</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="ti ti-credit-card"></i>
                    <span class="hide-menu">Payments</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="ti ti-user-circle"></i>
                    <span class="hide-menu">Clients</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="ti ti-briefcase"></i>
                    <span class="hide-menu">Projects</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="ti ti-file-analytics"></i>
                    <span class="hide-menu">Reports</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="ti ti-brain"></i>
                    <span class="hide-menu">Ai feedback</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link">
                    <i class="ti ti-users"></i>
                    <span class="hide-menu">Users</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
<!-- Sidebar End -->
