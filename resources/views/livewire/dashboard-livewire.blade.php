<div>
    <div class="container-fluid" style="padding-top: 8rem;">
        <div class="row g-3">
            {{-- Top row: key analytics --}}
            <div class="col-lg-8 col-12">
                <div class="card shadow border-0 app-card h-100">
                    <div class="card-body py-3 px-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="text-sm fw-light app-text-primary mb-0">Basic Analytics</h4>
                        </div>
                        @livewire('basic-dashboard-analytics-livewire')
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="card shadow border-0 app-card h-100">
                    <div class="card-body py-3 px-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="text-sm fw-light app-text-primary mb-0">Revenue Overview</h4>
                        </div>
                        @livewire('revenue-dashboard-livewire')
                    </div>
                </div>
            </div>

            {{-- Bottom row: projects & students --}}
            <div class="col-md-6 mb-3">
                <div class="card shadow border-0 app-card h-100">
                    <div class="card-body py-3 px-3">
                        <h4 class="text-sm fw-light app-text-primary mb-2">Projects</h4>
                        @livewire('project-status-livewire')
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card shadow border-0 app-card h-100">
                    <div class="card-body py-3 px-3">
                        <h4 class="text-sm fw-light app-text-primary mb-2">Students</h4>
                        @livewire('student-overview-livewire')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>