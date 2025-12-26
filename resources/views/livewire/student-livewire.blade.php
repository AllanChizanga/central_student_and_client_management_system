<div>
    <div class="container-fluid" style="padding-top: 8rem !important;">
        @livewire('create-student-livewire')
        @livewire('update-student-livewire')

        <div class="py-2">
            <div class="d-flex align-items-center justify-content-between rounded app-bg-elevated px-4 py-2 mb-3 shadow">
                <div class="d-flex align-items-center gap-3">
                    <h4 class="text-sm fw-light app-text-primary mb-2">
                        <i class="ti ti-users me-2"></i>
                        Manage Students
                    </h4>
                </div>
                <div class="d-flex gap-2">
                    <button
                        wire:click="view_create_student_modal"
                        class="btn app-btn btn-sm fw-semibold shadow-sm"
                    >
                        <i class="ti ti-user-plus me-1"></i> Add Student
                    </button>
                    <button class="btn app-btn btn-sm fw-semibold shadow-sm">
                        <i class="ti ti-file-upload me-1"></i> Upload from Excel
                    </button>
                </div>
            </div>

            <div class="mb-3">
                <div class="row g-4 align-items-end mt-4 mb-4">
                    <div class="col-md-6 col-sm-12">
                        <label for="search" class="form-label mb-1 text-white">Search</label>
                        <input
                            type="text"
                            id="search"
                            wire:model.live.debounce.400ms="search"
                            placeholder="Search by name, email, or student number..."
                            class="form-control shadow-sm py-3 px-4 fs-5"
                        >
                    </div>
                    <div class="col-md-3 col-sm-6 d-flex flex-column align-items-start">
                        <label for="enrollment" class="form-label mb-1 text-white">Enrollment Status</label>
                        <select
                            id="enrollment"
                            wire:model.live="filter_enrollment"
                            class="form-select form-select-md shadow-sm text-white bg-dark border-0 py-3 px-4 fs-5 w-100"
                            style="min-width: 230px;"
                        >
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
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="table-responsive">
                            <table class="table p-5 rounded">
                                <thead>
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