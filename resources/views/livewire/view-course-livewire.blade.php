<div>
    <div class="container-fluid mt-0 pt-0">
        <div>
            <div class="d-flex align-items-center justify-content-between rounded app-bg-elevated px-4 pb-2 mb-0 shadow mt-0 pt-0">
                <div class="d-flex align-items-center">
                    <h4 class="text-sm fw-light app-text-primary mb-0">
                        <i class="ti ti-book me-2"></i>
                        Manage Courses
                    </h4>
                </div>
                <div class="d-flex">
                    <button
                        wire:click="initiate_open_add_course_modal"
                        wire:loading.attr="disabled"
                        wire:target="initiate_open_add_course_modal"
                        class="btn app-btn btn-sm fw-semibold shadow-sm d-flex align-items-center"
                    >
                        <span wire:loading.remove wire:target="initiate_open_add_course_modal">
                            <i class="ti ti-plus me-1"></i> Add Course
                        </span>
                        <span wire:loading wire:target="initiate_open_add_course_modal">
                            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                            Adding...
                        </span>
                    </button>
                </div>
            </div> 
            <div class="mb-3 mt-4">
                <div class="row g-4 align-items-end">
                    <div class="col-md-6 col-sm-12">
                        <label for="search" class="form-label mb-1 text-white">Search</label>
                        <input
                            type="text"
                            id="search"
                            wire:model.live.debounce.400ms="search"
                            placeholder="Search by course name, category, or mode..."
                            class="form-control shadow-sm py-3 px-4 fs-5"
                        >
                    </div>
                </div>
            </div>

            <div>
                <div class="row align-items-end">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table p-0 rounded">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Syllabus</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Active</th>
                                        <th scope="col">Duration (months)</th>
                                        <th scope="col">Mode of Learning</th>
                                        <th scope="col">Total Fee</th>
                                        <th scope="col">Monthly Fee</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($courses as $index => $course)
                                        <tr>
                                            <td>{{  $index+1 }}</td>
                                            <td>{{ $course->name ?? '-' }}</td>
                                            <td>
                                                <button
                                                    class="btn btn-link btn-sm text-decoration-underline p-0"
                                                    wire:click="stream_syllabus('{{$course->id}}')"
                                                    title="View Syllabus"
                                                    type="button"
                                                >
                                                    View Syllabus
                                                </button>
                                            </td>
                                            <td>{{ $course->category ?? '-' }}</td>
                                            <td>
                                                @if($course->active)
                                                    <span class="badge bg-success">Yes</span>
                                                @else
                                                    <span class="badge bg-secondary">No</span>
                                                @endif
                                            </td>
                                            <td>{{ $course->duration_months ?? '-' }}</td>
                                            <td>{{ $course->mode_of_learning ?? '-' }}</td>
                                            <td>{{ $course->total_fee ? ($course->fee_currency . ' ' . number_format($course->total_fee, 2)) : '-' }}</td>
                                            <td>{{ $course->monthly_fee ? ($course->fee_currency . ' ' . number_format($course->monthly_fee, 2)) : '-' }}</td>
                                            <td>
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <button
                                                        wire:click="initiate_update_course('{{ $course->id }}')"
                                                        class="btn btn-link btn-sm text-primary p-0"
                                                        title="Edit"
                                                        wire:target="initiate_update_course('{{ $course->id }}')"
                                                        wire:loading.attr="disabled"
                                                    >
                                                        <span wire:loading.remove wire:target="initiate_update_course('{{ $course->id }}')">
                                                            <i class="ti ti-pencil"></i>
                                                        </span>
                                                        <span wire:loading wire:target="initiate_update_course('{{ $course->id }}')">
                                                            <span class="spinner-border spinner-border-sm text-primary align-middle" role="status" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Loading...</span>
                                                        </span>
                                                    </button>
                                                    <button
                                                        wire:click="delete('{{$course->id}}')"
                                                        class="btn btn-link btn-sm text-danger p-0"
                                                        title="Delete"
                                                        wire:target="deleteCourse"
                                                        wire:loading.attr="disabled"
                                                    >
                                                        <span wire:loading.remove wire:target="deleteCourse">
                                                            <i class="ti ti-trash"></i>
                                                        </span>
                                                        <span wire:loading wire:target="deleteCourse">
                                                            <span class="spinner-border spinner-border-sm text-danger align-middle" role="status" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Loading...</span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-muted" colspan="9">No courses found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    // Listen for Livewire not-authorized-to-delete dispatched event
    document.addEventListener('not-authorized-to-delete', function () {
        // Show error notification using Notyf with red color
        const notyf = new Notyf({
            duration: 3000,
            position: { x: 'right', y: 'top' },
            types: [
                {
                    type: 'error',
                    background: '#dc2626', // Tailwind red-600
                    icon: {
                        className: 'notyf__icon--error',
                        tagName: 'i',
                        text: '✖'
                    }
                }
            ]
        });
        notyf.open({
            type: 'error',
            message: 'You are not authorized to delete this course.'
        });
    });
</script>
</div>
