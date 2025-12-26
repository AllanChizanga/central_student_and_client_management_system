<div>
    <div class="container-fluid" style="padding-top: 8rem;">
        <div class="row">
            <!-- First Card: Full width (12 columns) -->
            <div class="col-12 mb-3">
                <div class="card shadow border-0 app-card">
                    <div class="card-body py-3 px-3">
                        <h4 class="text-sm fw-light app-text-primary mb-2">Revenue</h4>
                        
                            @livewire('revenue-dashboard-livewire')
                        
                </div>
            </div>
            </div>
            <!-- Second Card: Half width (6 columns) -->
            <div class="col-md-6 mb-4">
                <div class="card shadow border-0 app-card">
                    <div class="card-body">
                        <h4 class="text-sm fw-light app-text-primary mb-2">Projects</h4>
                        @livewire('project-status-livewire')
                    </div>
                </div>
            </div>
            <!-- Third Card: Half width (6 columns) -->
            <div class="col-md-6 mb-4">
                <div class="card shadow border-0 app-card">
                    <div class="card-body">
                        <h4 class="text-sm fw-light app-text-primary mb-2">Students</h4>
                        @livewire('student-overview-livewire')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>