<div> 
    @livewire('create-project-version-payment-livewire')
    <div class="container-fluid mt-0 pt-0">
        <div>
            <div class="d-flex align-items-center justify-content-between rounded app-bg-elevated px-4 pb-2 mb-0 shadow mt-0 pt-0">
                <div class="d-flex align-items-center">
                    <h4 class="text-sm fw-light app-text-primary mb-0">
                        <i class="ti ti-layers-stack me-2"></i>
                        Manage Project Versions
                    </h4>
                </div>
                <div class="d-flex">
                    <button
                        wire:click="initiate_open_add_project_version_modal"
                        wire:loading.attr="disabled"
                        wire:target="initiate_open_add_project_version_modal"
                        class="btn app-btn btn-sm fw-semibold shadow-sm d-flex align-items-center"
                    >
                        <span wire:loading.remove wire:target="initiate_open_add_project_version_modal">
                            <i class="ti ti-plus me-1"></i> Add Project Version
                        </span>
                        <span wire:loading wire:target="initiate_open_add_project_version_modal">
                            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                            Adding...
                        </span>
                    </button>
                </div>
            </div>

            {{-- Session Success and Error Messages --}}
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <i class="ti ti-circle-check me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('error'))
                <div 
                    class="alert alert-danger alert-dismissible fade show mt-3 blink-soft" 
                    role="alert"
                >
                    <i class="ti ti-alert-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <style>
                    @keyframes blinkSoft {
                        0%, 100% { opacity: 1; }
                        50% { opacity: 0.6; }
                    }
                    .blink-soft {
                        animation: blinkSoft 1.4s infinite;
                    }
                </style>
            @endif

            <div class="mb-3 mt-4">
                <div class="row g-4 align-items-end">
                    <div class="col-md-6 col-sm-12">
                        <label for="search" class="form-label mb-1 text-white">Search</label>
                        <input
                            type="text"
                            id="search"
                            wire:model.live.debounce.400ms="search"
                            placeholder="Search by version name, client, or status..."
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
                                        <th scope="col">Version</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Client</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">End Date</th>
                                        <th scope="col">Sprint (days)</th>
                                        <th scope="col">AI?</th>
                                        <th scope="col">Payments?</th>
                                        <th scope="col">WhatsApp?</th>
                                        <th scope="col">Other Int?</th>
                                        <th scope="col">Maintenance</th>
                                        <th scope="col">Monthly Fee</th>
                                        <th scope="col">Billing</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Paid</th>
                                        <th scope="col">Balance</th>
                                        <th scope="col">Currency</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($project_versions as $index => $project_version)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $project_version->version_number ?? '-' }}</td>
                                            <td>
                                                {{ $project_version->project_version_name ?? '-' }}
                                                <button
                                                    class="btn btn-sm btn-outline-primary ms-2"
                                                    wire:click="download_invoice('{{ $project_version->id }}')"
                                                    wire:target="download_invoice('{{ $project_version->id }}')"
                                                    wire:loading.attr="disabled"
                                                    title="Download Invoice"
                                                >
                                                    <span wire:loading.remove wire:target="download_invoice('{{ $project_version->id }}')">
                                                        <i class="bi bi-download"></i> Invoice
                                                    </span>
                                                    <span wire:loading wire:target="download_invoice('{{ $project_version->id }}')">
                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                        Downloading...
                                                    </span>
                                                </button>
                                            </td>
                                            <td>{{ $project_version->client->company_name ?? '-' }}</td>
                                            <td>
                                                <span class="badge
                                                    @if($project_version->project_progress_status === 'mvp_release') bg-warning text-dark
                                                    @elseif($project_version->project_progress_status === 'production') bg-success
                                                    @elseif($project_version->project_progress_status === 'maintenance_mode') bg-secondary
                                                    @elseif($project_version->project_progress_status === 'sprint_development') bg-primary
                                                    @else bg-muted text-dark
                                                    @endif
                                                ">
                                                    {{ ucwords(str_replace('_', ' ', $project_version->project_progress_status)) }}
                                                </span>
                                            </td>
                                            <td>{{ $project_version->start_date ? $project_version->start_date->format('Y-m-d') : '-' }}</td>
                                            <td>{{ $project_version->end_date ? $project_version->end_date->format('Y-m-d') : '-' }}</td>
                                            <td>
                                                {{ $project_version->sprint_duration_days ?? 0 }}
                                            </td>
                                            <td>
                                                <span class="badge {{ $project_version->has_ai_integration ? 'bg-success' : 'bg-muted' }}">
                                                    {{ $project_version->has_ai_integration ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $project_version->has_payments_integration ? 'bg-success' : 'bg-muted' }}">
                                                    {{ $project_version->has_payments_integration ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $project_version->has_whatsapp_integration ? 'bg-success' : 'bg-muted' }}">
                                                    {{ $project_version->has_whatsapp_integration ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $project_version->has_other_third_party_integrations ? 'bg-success' : 'bg-muted' }}">
                                                    {{ $project_version->has_other_third_party_integrations ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $project_version->maintenance_type === 'monthly' ? 'bg-primary' : 'bg-secondary' }}">
                                                    {{ ucfirst($project_version->maintenance_type) }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ number_format($project_version->maintenance_fee_monthly ?? 0, 2) }}
                                            </td>
                                            <td>
                                                <span class="badge {{ $project_version->billing_type === 'milestone' ? 'bg-info text-dark' : 'bg-secondary' }}">
                                                    {{ ucfirst($project_version->billing_type) }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ number_format($project_version->amount ?? 0, 2) }}
                                            </td>
                                            <td>
                                                {{ number_format($project_version->paid ?? 0, 2) }}
                                            </td>
                                            <td>
                                                {{ number_format($project_version->balance ?? 0, 2) }}
                                            </td>
                                            <td>
                                                {{ $project_version->currency ?? 'USD' }}
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <button
                                                        wire:click="initiate_update_project_version('{{ $project_version->id }}')"
                                                        class="btn btn-link btn-sm text-primary p-0"
                                                        title="Edit"
                                                        wire:target="initiate_update_project_version('{{ $project_version->id }}')"
                                                        wire:loading.attr="disabled"
                                                    >
                                                        <span wire:loading.remove wire:target="initiate_update_project_version('{{ $project_version->id }}')">
                                                            <i class="ti ti-pencil"></i>
                                                        </span>
                                                        <span wire:loading wire:target="initiate_update_project_version('{{ $project_version->id }}')">
                                                            <span class="spinner-border spinner-border-sm text-primary align-middle" role="status" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Loading...</span>
                                                        </span>
                                                    </button>
                                                    <button
                                                        wire:click="open_milestone_creation('{{ $project_version->id }}')"
                                                        class="btn btn-link btn-sm text-success p-0"
                                                        title="Create Milestones"
                                                        wire:target="open_milestone_creation('{{ $project_version->id }}')"
                                                        wire:loading.attr="disabled"
                                                    >
                                                        <span wire:loading.remove wire:target="open_milestone_creation('{{ $project_version->id }}')">
                                                            <i class="ti ti-flag"></i>
                                                        </span>
                                                        <span wire:loading wire:target="open_milestone_creation('{{ $project_version->id }}')">
                                                            <span class="spinner-border spinner-border-sm text-success align-middle" role="status" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Loading...</span>
                                                        </span>
                                                    </button>
                                                    <button
                                                        wire:click="pay_for_project_version('{{ $project_version->id }}')"
                                                        class="btn btn-link btn-sm text-warning p-0"
                                                        title="Pay"
                                                        wire:target="pay_for_project_version('{{ $project_version->id }}')"
                                                        wire:loading.attr="disabled"
                                                    >
                                                        <span wire:loading.remove wire:target="pay_for_project_version('{{ $project_version->id }}')">
                                                            <i class="ti ti-credit-card"></i>
                                                        </span>
                                                        <span wire:loading wire:target="pay_for_project_version('{{ $project_version->id }}')">
                                                            <span class="spinner-border spinner-border-sm text-warning align-middle" role="status" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Processing...</span>
                                                        </span>
                                                    </button>
                                                    <button
                                                        wire:click="delete('{{ $project_version->id }}')"
                                                        class="btn btn-link btn-sm text-danger p-0"
                                                        title="Delete"
                                                        wire:target="delete('{{ $project_version->id }}')"
                                                        wire:loading.attr="disabled"
                                                    >
                                                        <span wire:loading.remove wire:target="delete('{{ $project_version->id }}')">
                                                            <i class="ti ti-trash"></i>
                                                        </span>
                                                        <span wire:loading wire:target="delete('{{ $project_version->id }}')">
                                                            <span class="spinner-border spinner-border-sm text-danger align-middle" role="status" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Loading...</span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-muted" colspan="20">No project versions found.</td>
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
        document.addEventListener('not-authorized', function () {
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
                message: 'You are not authorized to delete this project version.'
            });
        });
    </script>
</div>
