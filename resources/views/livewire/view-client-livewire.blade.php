<div>
    <div class="container-fluid mt-0 pt-0">
        <div>
            <div class="d-flex align-items-center justify-content-between rounded app-bg-elevated px-4 pb-2 mb-0 shadow mt-0 pt-0">
                <div class="d-flex align-items-center">
                    <h4 class="text-sm fw-light app-text-primary mb-0">
                        <i class="ti ti-users me-2"></i>
                        Manage Clients
                    </h4>
                </div>
                <div class="d-flex">
                    <button
                        wire:click="initiate_open_add_client_modal"
                        wire:loading.attr="disabled"
                        wire:target="initiate_open_add_client_modal"
                        class="btn app-btn btn-sm fw-semibold shadow-sm d-flex align-items-center"
                    >
                        <span wire:loading.remove wire:target="initiate_open_add_client_modal">
                            <i class="ti ti-plus me-1"></i> Add Client
                        </span>
                        <span wire:loading wire:target="initiate_open_add_client_modal">
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
                            placeholder="Search by company, name, or city..."
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
                                        <th scope="col">Company</th>
                                        <th scope="col">Industry</th>
                                        <th scope="col">Revenue</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">City</th>
                                        <th scope="col">Occupation</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($clients as $index => $client)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $client->company_name ?? '-' }}</td>
                                            <td>{{ $client->industry ?? '-' }}</td>
                                            <td>
                                                {{ $client->lifetime_revenue_contribution ? number_format($client->lifetime_revenue_contribution, 2) : '0.00' }}
                                            </td>
                                            <td>{{ $client->country ?? '-' }}</td>
                                            <td>{{ $client->city ?? '-' }}</td>
                                            <td>{{ $client->occupation ?? '-' }}</td>
                                            <td>
                                                <span class="badge 
                                                    {{ $client->client_type === 'individual' ? 'bg-primary' : 'bg-secondary' }}">
                                                    {{ ucfirst($client->client_type) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge
                                                    @if($client->client_status === 'lead') bg-warning text-dark
                                                    @elseif($client->client_status === 'active') bg-success
                                                    @else bg-muted text-dark
                                                    @endif
                                                ">
                                                    {{ ucfirst($client->client_status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <button
                                                        wire:click="initiate_update_client('{{ $client->id }}')"
                                                        class="btn btn-link btn-sm text-primary p-0"
                                                        title="Edit"
                                                        wire:target="initiate_update_client('{{ $client->id }}')"
                                                        wire:loading.attr="disabled"
                                                    >
                                                        <span wire:loading.remove wire:target="initiate_update_client('{{ $client->id }}')">
                                                            <i class="ti ti-pencil"></i>
                                                        </span>
                                                        <span wire:loading wire:target="initiate_update_client('{{ $client->id }}')">
                                                            <span class="spinner-border spinner-border-sm text-primary align-middle" role="status" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Loading...</span>
                                                        </span>
                                                    </button>
                                                    <button
                                                        wire:click="delete('{{ $client->id }}')"
                                                        class="btn btn-link btn-sm text-danger p-0"
                                                        title="Delete"
                                                        wire:target="deleteClient"
                                                        wire:loading.attr="disabled"
                                                    >
                                                        <span wire:loading.remove wire:target="deleteClient">
                                                            <i class="ti ti-trash"></i>
                                                        </span>
                                                        <span wire:loading wire:target="deleteClient">
                                                            <span class="spinner-border spinner-border-sm text-danger align-middle" role="status" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Loading...</span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center text-muted" colspan="10">No clients found.</td>
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
                message: 'You are not authorized to delete this client.'
            });
        });
    </script>
</div>
