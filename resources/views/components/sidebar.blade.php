<!-- Sidebar Start -->
<aside class="left-sidebar mt-2 app-bg-elevated pb-4 shadow" style="min-height: 100vh; box-shadow: 0 0 24px 0 rgba(0,0,0,0.15) !important; border-right: none !important;">
    <!-- Add white space on top -->
    <div class="pt-3"></div>
    <!-- Sidebar navigation with scroll effect using Tailwind and overflow-auto and custom scrollbar -->
    <nav class="sidebar-nav overflow-auto custom-scrollbar" style="max-height: calc(70vh - 2rem);">
        <ul id="sidebarnav" class="pb-8">
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="{{ route('dashboard') }}"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="View dashboard overview, stats, and recent activity">
                    <i class="ti ti-layout-grid"></i>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="{{ route('student') }}"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="Browse, create, or manage student records">
                    <i class="ti ti-user"></i>
                    <span class="hide-menu">Students</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="{{ route('course') }}"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="View and manage available courses">
                    <i class="ti ti-book"></i>
                    <span class="hide-menu">Courses</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="{{ route('intake') }}"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="View and manage course intakes">
                    <i class="ti ti-calendar-event"></i>
                    <span class="hide-menu">Intakes</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="{{ route('enrollment') }}"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="View and manage course enrollments">
                    <i class="ti ti-clipboard-list"></i>
                    <span class="hide-menu">Enrollments</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="#"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="View and manage student and client payments">
                    <i class="ti ti-credit-card"></i>
                    <span class="hide-menu">Payments</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="{{ route('client') }}"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="Browse and manage client accounts">
                    <i class="ti ti-user-circle"></i>
                    <span class="hide-menu">Clients</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="{{ route('project-version') }}"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="Manage or view project details and status">
                    <i class="ti ti-briefcase"></i>
                    <span class="hide-menu">Project Version</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="#"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="View analytics and generate reports">
                    <i class="ti ti-file-analytics"></i>
                    <span class="hide-menu">Reports</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="#"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="Get AI-generated feedback for assignments or work">
                    <i class="ti ti-brain"></i>
                    <span class="hide-menu">Ai feedback</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="#"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="View and manage application users">
                    <i class="ti ti-users"></i>
                    <span class="hide-menu">Users</span>
                </a>
            </li>

            <!-- Payroll & HR Links -->
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="#"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="View and manage employees">
                    <i class="ti ti-id-badge"></i>
                    <span class="hide-menu">Employees</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="#"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="View and manage payroll profiles">
                    <i class="ti ti-address-book"></i>
                    <span class="hide-menu">Payroll Profiles</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="#"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="Run and manage payroll cycles">
                    <i class="ti ti-calculator"></i>
                    <span class="hide-menu">Payroll Runs</span>
                </a>
            </li>
            <!-- End Payroll & HR Links -->

            <!-- Newly added links -->
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="{{ route('dashboard') }}"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="View and manage dropout records">
                    <i class="ti ti-arrow-down-circle"></i>
                    <span class="hide-menu">Dropouts</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="{{ route('dashboard') }}"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="View and manage admin fees">
                    <i class="ti ti-cash"></i>
                    <span class="hide-menu">Admin Fees</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="{{ route('dashboard') }}"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="Manage regular operating expenses">
                    <i class="ti ti-building-bank"></i>
                    <span class="hide-menu">Operating Expenses</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="{{ route('dashboard') }}"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="View expense instances (monthly or scheduled)">
                    <i class="ti ti-currency-dollar"></i>
                    <span class="hide-menu">Expense Instances</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-white"
                   href="{{ route('dashboard') }}"
                   data-bs-toggle="tooltip"
                   data-bs-placement="right"
                   title="Perform and review tax calculations">
                    <i class="ti ti-percentage"></i>
                    <span class="hide-menu">Tax Calculations</span>
                </a>
            </li>
            <!-- End newly added links -->

            <li class="sidebar-item">
                <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="sidebar-link btn btn-link fw-semibold d-flex align-items-center p-0 text-white"
                        style="text-decoration: none;"
                        data-bs-toggle="tooltip" data-bs-placement="right" title="Logout of admin dashboard">
                        <i class="ti ti-logout me-1"></i>
                        <span class="hide-menu">Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</aside>
<!-- Sidebar End -->
