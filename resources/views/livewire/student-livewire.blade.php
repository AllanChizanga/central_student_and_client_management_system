<div>
    <div class="container-fluid pt-5" style="padding-top: 8rem !important;">

        @livewire('create-student-livewire')
        @livewire('update-student-livewire')

        <div class="py-2">
            <div class="d-flex align-items-center justify-content-between rounded bg-primary bg-gradient px-4 py-2 mb-3 shadow">
                <div class="d-flex align-items-center gap-3">
                    <i class="ti ti-graduate text-white" style="font-size: 28px;"></i>
                    <h2 class="h4 fw-bold text-white mb-0">Manage Students</h2>
                </div>
                <div class="d-flex gap-2">
                    <button wire:click="view_create_student_modal" class="btn btn-light btn-sm fw-semibold shadow-sm">
                        <i class="ti ti-user-plus me-1"></i> Add Student
                    </button>
                    <button wire:click="uploadExcel" class="btn btn-success btn-sm fw-semibold shadow-sm">
                        <i class="ti ti-file-upload me-1"></i> Upload from Excel
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <div class="row g-2 align-items-end">
                    <div class="col-md-6 col-sm-12">
                        <label for="search" class="form-label mb-1">Search</label>
                        <input
                            type="text"
                            id="search"
                            wire:model.live.debounce.400ms="search"
                            placeholder="Search by name, email, or student number..."
                            class="form-control shadow-sm"
                        >
                    </div>
                   
                    <div class="col-md-3 col-sm-6">
                        <label for="enrollment" class="form-label mb-1">Enrollment Status</label>
                        <select id="enrollment" wire:model.live="filter_enrollment" class="form-select shadow-sm">
                            <option value="">All</option>
                            <option value="enrolled">Enrolled</option>
                            <option value="pending">Pending</option>
                            <option value="graduated">Graduated</option>
                            <option value="dropped">Dropped</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row g-4">

                <!-- Student Table -->
                <div class="col-12 col-lg-12">
                    <div class="card shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Student Number</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Enrollment</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">City</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($students as $index => $student)
                                        <tr>
                                            <td>{{ $students->firstItem() + $index }}</td>
                                            <td>{{ $student->student_number ?? '-' }}</td>
                                            <td>{{ $student->user->fullname ?? '-' }}</td>
                                            <td>{{ $student->user->phonenumber ?? '-' }}</td>
                                            <td>{{ $student->enrollment_status ?? '-' }}</td>
                                            <td class="text-capitalize">{{ $student->gender ?? '-' }}</td>
                                            <td>{{ $student->city ?? '-' }}</td>
                                            <td>
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <button wire:click="initiate_update_student('{{ $student->id }}')" class="btn btn-link btn-sm text-primary p-0" title="Edit">
                                                        <i class="ti ti-pencil"></i>
                                                    </button>
                                                    <button wire:click="delete('{{ $student->id }}')" class="btn btn-link btn-sm text-danger p-0" title="Delete">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-muted" colspan="8">No students found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body py-2">
                            {{ $students->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    window.addEventListener('not-authorized-to-delete-student', () => {
        const notyf = new Notyf({
            duration: 3000,
            position: { x: 'right', y: 'top' },
            types: [
                {
                    type: 'error',
                    background: '#dc3545',
                    icon: {
                        className: 'fas fa-times',
                        tagName: 'i',
                        color: '#fff'
                    }
                }
            ]
        });
        notyf.open({
            type: 'error',
            message: 'You are not authorized to delete this student.'
        });
    });
</script>
</div>