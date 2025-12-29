<div>
    <div class="container-fluid mt-0 pt-0">
        <div>
            <div class="d-flex align-items-center justify-content-between rounded app-bg-elevated px-4 pb-2 mb-0 shadow mt-0 pt-0">
                <div class="d-flex align-items-center">
                    <h4 class="text-sm fw-light app-text-primary mb-0">
                        <i class="ti ti-users me-2"></i>
                        Manage Enrollments
                    </h4>
                </div>
                <div>
                    <button
                        class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2 fw-semibold"
                        wire:click="initiate_view_enrollment_modal"
                    >
                        <i class="ti ti-plus"></i>
                        Add Enrollment
                    </button>
                </div>
            </div>
            <div class="mb-3 mt-4">
                <div class="row g-4 align-items-end">
                    <div class="col-md-6 col-sm-12">
                        <label for="enrollment-search" class="form-label mb-1 text-white">Search</label>
                        <input
                            type="text"
                            id="enrollment-search"
                            wire:model.live.debounce.400ms="search"
                            placeholder="Search by student name, course, or cohort..."
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
                                        <th scope="col">Student Number</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Course Name</th>
                                        <th scope="col">Cohort</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Paid</th>
                                        <th scope="col">Balance</th>
                                        <th scope="col">Enrollment Date</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($enrollments as $index => $enrollment)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                {{ $enrollment->student && $enrollment->student->student_number
                                                    ? $enrollment->student->student_number
                                                    : '-' }}
                                            </td>
                                            <td>
                                                {{ $enrollment->student && $enrollment->student->user && $enrollment->student->user->fullname
                                                    ? $enrollment->student->user->fullname
                                                    : '-' }}
                                            </td>
                                            <td>
                                                {{ $enrollment->course && $enrollment->course->name
                                                    ? $enrollment->course->name
                                                    : '-' }}
                                            </td>
                                            <td>
                                                {{ $enrollment->intake && $enrollment->intake->cohort
                                                    ? $enrollment->intake->cohort
                                                    : '-' }}
                                            </td>
                                            <td>
                                                <span class="badge 
                                                    @if($enrollment->status === 'enrolled') bg-success
                                                    @elseif($enrollment->status === 'pending') bg-warning text-dark
                                                    @elseif($enrollment->status === 'graduated') bg-info
                                                    @elseif($enrollment->status === 'dropped') bg-danger
                                                    @elseif($enrollment->status === 'suspended') bg-secondary
                                                    @else bg-light text-dark
                                                    @endif
                                                ">
                                                    {{ ucfirst($enrollment->status ?? '-') }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ $enrollment->currency ?? '' }} {{ number_format($enrollment->amount, 2) }}
                                            </td>
                                            <td>
                                                {{ $enrollment->currency ?? '' }} {{ number_format($enrollment->paid, 2) }}
                                            </td>
                                            <td>
                                                {{ $enrollment->currency ?? '' }} {{ number_format($enrollment->balance, 2) }}
                                            </td>
                                            <td>
                                                {{ $enrollment->enrollment_date ? \Carbon\Carbon::parse($enrollment->enrollment_date)->format('Y-m-d') : '-' }}
                                            </td>
                                            <td class="text-center">
                                                <button
                                                    class="btn btn-sm btn-light text-primary me-1"
                                                    title="Edit"
                                                    wire:click="initiate_update_enrollment('{{ $enrollment->id }}')"
                                                    wire:loading.attr="disabled"
                                                    wire:target="initiate_update_enrollment('{{ $enrollment->id }}')"
                                                >
                                                    <span wire:loading.remove wire:target="initiate_update_enrollment('{{ $enrollment->id }}')">
                                                        <i class="ti ti-pencil"></i>
                                                    </span>
                                                    <span wire:loading wire:target="initiate_update_enrollment('{{ $enrollment->id }}')">
                                                        <span class="spinner-border spinner-border-sm align-middle me-1" role="status" aria-hidden="true"></span>
                                                    </span>
                                                </button>
                                                <button
                                                    class="btn btn-sm btn-light text-danger"
                                                    title="Delete"
                                                    wire:click="delete_enrollment('{{ $enrollment->id }}')"
                                                    wire:loading.attr="disabled"
                                                    wire:target="delete_enrollment('{{ $enrollment->id }}')"
                                                >
                                                    <span wire:loading.remove wire:target="delete_enrollment('{{ $enrollment->id }}')">
                                                        <i class="ti ti-trash"></i>
                                                    </span>
                                                    <span wire:loading wire:target="delete_enrollment('{{ $enrollment->id }}')">
                                                        <span class="spinner-border spinner-border-sm align-middle me-1" role="status" aria-hidden="true"></span>
                                                    </span>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-muted" colspan="11">
                                                No enrollments found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            {{-- Pagination links, if necessary --}}
                            @if ($enrollments)
                                {{ $enrollments->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
