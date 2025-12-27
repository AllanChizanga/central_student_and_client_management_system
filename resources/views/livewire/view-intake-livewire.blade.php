<div>
    <div class="container-fluid mt-0 pt-0">
        <div>
            <div class="d-flex align-items-center justify-content-between rounded app-bg-elevated px-4 pb-2 mb-0 shadow mt-0 pt-0">
                <div class="d-flex align-items-center">
                    <h4 class="text-sm fw-light app-text-primary mb-0">
                        <i class="ti ti-calendar-event me-2"></i>
                        Manage Intakes
                    </h4>
                </div>
                <div class="d-flex">
                    <button
                        wire:click="initiate_open_add_intake_modal"
                        wire:loading.attr="disabled"
                        wire:target="initiate_open_add_intake_modal"
                        class="btn app-btn btn-sm fw-semibold shadow-sm d-flex align-items-center"
                    >
                        <span wire:loading.remove wire:target="initiate_open_add_intake_modal">
                            <i class="ti ti-plus me-1"></i> Add Intake
                        </span>
                        <span wire:loading wire:target="initiate_open_add_intake_modal">
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
                            placeholder="Search by intake cohort..."
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
                                        <th scope="col">Cohort</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">Graduation Date</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($intakes as $index => $intake)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $intake->cohort ?? '-' }}</td>
                                            <td>
                                                {{ $intake->start_date ? \Carbon\Carbon::parse($intake->start_date)->format('j F Y') : '-' }}
                                            </td>
                                            <td>
                                                {{ $intake->graduation_date ? \Carbon\Carbon::parse($intake->graduation_date)->format('j F Y') : '-' }}
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <button
                                                        wire:click="initiate_update_intake('{{ $intake->id }}')"
                                                        class="btn btn-link btn-sm text-primary p-0"
                                                        title="Edit"
                                                        wire:target="initiate_update_intake('{{ $intake->id }}')"
                                                        wire:loading.attr="disabled"
                                                    >
                                                        <span wire:loading.remove wire:target="initiate_update_intake('{{ $intake->id }}')">
                                                            <i class="ti ti-pencil"></i>
                                                        </span>
                                                        <span wire:loading wire:target="initiate_update_intake('{{ $intake->id }}')">
                                                            <span class="spinner-border spinner-border-sm text-primary align-middle" role="status" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Loading...</span>
                                                        </span>
                                                    </button>
                                                    <button
                                                        wire:click="delete('{{ $intake->id }}')"
                                                        class="btn btn-link btn-sm text-danger p-0"
                                                        title="Delete"
                                                        wire:target="deleteIntake"
                                                        wire:loading.attr="disabled"
                                                    >
                                                        <span wire:loading.remove wire:target="deleteIntake">
                                                            <i class="ti ti-trash"></i>
                                                        </span>
                                                        <span wire:loading wire:target="deleteIntake">
                                                            <span class="spinner-border spinner-border-sm text-danger align-middle" role="status" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Loading...</span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-muted" colspan="5">No intakes found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            <!-- Additional UI or controls can be added here, if required -->
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
                        background: '#dc2626',
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
                message: 'You are not authorized to delete this intake.'
            });
        });
    </script>
</div>

