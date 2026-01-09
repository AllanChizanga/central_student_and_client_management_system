<div>
    <div class="row g-3">
        {{-- Students --}}
        <div class="col-md-6 col-12">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body py-3 px-3">
                    <div class="mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-uppercase text-muted small">Students</span>
                            <div class="d-flex flex-wrap gap-1">
                                <button type="button"
                                        class="btn btn-outline-primary btn-xs py-0 px-1 {{ $studentFilter === 'lifetime' ? 'active' : '' }}"
                                        wire:click="setStudentFilter('lifetime')">
                                    All
                                </button>
                                <button type="button"
                                        class="btn btn-outline-primary btn-xs py-0 px-1 {{ $studentFilter === 'yearly' ? 'active' : '' }}"
                                        wire:click="setStudentFilter('yearly')">
                                    Year
                                </button>
                                <button type="button"
                                        class="btn btn-outline-primary btn-xs py-0 px-1 {{ $studentFilter === 'monthly' ? 'active' : '' }}"
                                        wire:click="setStudentFilter('monthly')">
                                    Month
                                </button>
                            </div>
                        </div>
                    </div>
                    <h3 class="mb-0 fw-semibold">
                        {{ number_format($this->studentCount) }}
                    </h3>
                    <small class="text-muted">Total registered students</small>
                </div>
            </div>
        </div>

        {{-- Course Revenue --}}
        <div class="col-md-6 col-12">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body py-3 px-3">
                    <div class="mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-uppercase text-muted small">Course Revenue</span>
                            <div class="d-flex flex-wrap gap-1">
                                <button type="button"
                                        class="btn btn-outline-success btn-xs py-0 px-1 {{ $courseRevenueFilter === 'lifetime' ? 'active' : '' }}"
                                        wire:click="setCourseRevenueFilter('lifetime')">
                                    All
                                </button>
                                <button type="button"
                                        class="btn btn-outline-success btn-xs py-0 px-1 {{ $courseRevenueFilter === 'yearly' ? 'active' : '' }}"
                                        wire:click="setCourseRevenueFilter('yearly')">
                                    Year
                                </button>
                                <button type="button"
                                        class="btn btn-outline-success btn-xs py-0 px-1 {{ $courseRevenueFilter === 'monthly' ? 'active' : '' }}"
                                        wire:click="setCourseRevenueFilter('monthly')">
                                    Month
                                </button>
                            </div>
                        </div>
                    </div>
                    <h3 class="mb-0 fw-semibold">
                        USD {{ number_format($this->courseRevenue, 2) }}
                    </h3>
                    <small class="text-muted">Student course payments received</small>
                </div>
            </div>
        </div>

        {{-- Project Versions --}}
        <div class="col-md-6 col-12">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body py-3 px-3">
                    <div class="mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-uppercase text-muted small">Project Versions</span>
                            <div class="d-flex flex-wrap gap-1">
                                <button type="button"
                                        class="btn btn-outline-secondary btn-xs py-0 px-1 {{ $projectVersionFilter === 'lifetime' ? 'active' : '' }}"
                                        wire:click="setProjectVersionFilter('lifetime')">
                                    All
                                </button>
                                <button type="button"
                                        class="btn btn-outline-secondary btn-xs py-0 px-1 {{ $projectVersionFilter === 'yearly' ? 'active' : '' }}"
                                        wire:click="setProjectVersionFilter('yearly')">
                                    Year
                                </button>
                                <button type="button"
                                        class="btn btn-outline-secondary btn-xs py-0 px-1 {{ $projectVersionFilter === 'monthly' ? 'active' : '' }}"
                                        wire:click="setProjectVersionFilter('monthly')">
                                    Month
                                </button>
                            </div>
                        </div>
                    </div>
                    <h3 class="mb-0 fw-semibold">
                        {{ number_format($this->projectVersionCount) }}
                    </h3>
                    <small class="text-muted">Active & historical project versions</small>
                </div>
            </div>
        </div>

        {{-- Project Revenue --}}
        <div class="col-md-6 col-12">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body py-3 px-3">
                    <div class="mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-uppercase text-muted small">Project Revenue</span>
                            <div class="d-flex flex-wrap gap-1">
                                <button type="button"
                                        class="btn btn-outline-info btn-xs py-0 px-1 {{ $projectRevenueFilter === 'lifetime' ? 'active' : '' }}"
                                        wire:click="setProjectRevenueFilter('lifetime')">
                                    All
                                </button>
                                <button type="button"
                                        class="btn btn-outline-info btn-xs py-0 px-1 {{ $projectRevenueFilter === 'yearly' ? 'active' : '' }}"
                                        wire:click="setProjectRevenueFilter('yearly')">
                                    Year
                                </button>
                                <button type="button"
                                        class="btn btn-outline-info btn-xs py-0 px-1 {{ $projectRevenueFilter === 'monthly' ? 'active' : '' }}"
                                        wire:click="setProjectRevenueFilter('monthly')">
                                    Month
                                </button>
                            </div>
                        </div>
                    </div>
                    <h3 class="mb-0 fw-semibold">
                        USD {{ number_format($this->projectRevenue, 2) }}
                    </h3>
                    <small class="text-muted">Project payments received</small>
                </div>
            </div>
        </div>
    </div>
</div>

