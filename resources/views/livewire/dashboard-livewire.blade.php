<div>
    <div class="container-fluid" style="padding-top: 8rem;">
        <div class="row">
            <!-- First Card: Full width (12 columns) -->
            <div class="col-12 mb-4">
                <div class="card shadow border-0 bg-white">
                    <div class="card-body">
                        <h2>Monthly Revenue</h2>
                        @livewire('revenue-dashboard-livewire')
                    </div>
                </div>
            </div>
            <!-- Second Card: Half width (6 columns) -->
            <div class="col-md-6 mb-4">
                <div class="card shadow border-0 bg-white">
                    <div class="card-body">
                        <h3 class="fw-semibold text-primary mb-3">Project Status</h3>
                        @livewire('project-status-livewire')
                    </div>
                </div>
            </div>
            <!-- Third Card: Half width (6 columns) -->
            <div class="col-md-6 mb-4">
                <div class="card shadow border-0 bg-white">
                    <div class="card-body">
                        <h3 class="fw-semibold text-primary mb-3">Students Overview</h3>
                        @livewire('student-overview-livewire')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>