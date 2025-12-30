<div>
    <div class="container-fluid p-0" style="margin-top: -18px;">
        <!-- Create Project Version Modal -->
        <div wire:ignore.self class="modal fade" id="createProjectVersionModal" tabindex="-1" aria-labelledby="createProjectVersionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form wire:submit.prevent="create_project_version" class="modal-content app-card">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title app-text-primary" id="createProjectVersionModalLabel">Create New Project Version</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">

                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show app-text-primary" role="alert">
                                    <small class="text-danger">{{ session('error') }}</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="col-md-6">
                                <label for="client_id" class="form-label app-text-primary">Client</label>
                                <select wire:model.defer="client_id" id="client_id" class="form-select @error('client_id') is-invalid @enderror">
                                    <option value="">Select client</option>
                                    @isset($clients)
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">
                                                {{ $client->company_name }}
                                                @if($client->user)
                                                    ({{ $client->user->fullname ?? $client->user->email }})
                                                @endif
                                            </option>
                                        @endforeach
                                    @endisset
                                </select>
                                @error('client_id')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="version_number" class="form-label app-text-primary">Version Number</label>
                                <input type="number" wire:model.defer="version_number" id="version_number" class="form-control @error('version_number') is-invalid @enderror" min="1" placeholder="Enter version number">
                                @error('version_number')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-12">
                                <label for="project_version_name" class="form-label app-text-primary">Project Version Name</label>
                                <input type="text" wire:model.defer="project_version_name" id="project_version_name" class="form-control @error('project_version_name') is-invalid @enderror" maxlength="255" placeholder="Enter project version name">
                                @error('project_version_name')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="project_progress_status" class="form-label app-text-primary">Project Progress Status</label>
                                <select wire:model.defer="project_progress_status" id="project_progress_status" class="form-select @error('project_progress_status') is-invalid @enderror">
                                    <option value="">Select status</option>
                                    <option value="backlog_development">Backlog Development</option>
                                    <option value="backlog_review">Backlog Review</option>
                                    <option value="sprint_development">Sprint Development</option>
                                    <option value="mvp_release">MVP Release</option>
                                    <option value="production">Production</option>
                                    <option value="maintenance_mode">Maintenance Mode</option>
                                </select>
                                @error('project_progress_status')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="start_date" class="form-label app-text-primary">Start Date</label>
                                <input type="date" wire:model.defer="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror">
                                @error('start_date')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label app-text-primary">End Date</label>
                                <input type="date" wire:model.defer="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror">
                                @error('end_date')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="brd_document" class="form-label app-text-primary">BRD Document</label>
                                <input type="file" wire:model.defer="brd_document" id="brd_document" class="form-control @error('brd_document') is-invalid @enderror">
                                @error('brd_document')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="contract" class="form-label app-text-primary">Contract</label>
                                <input type="file" wire:model.defer="contract" id="contract" class="form-control @error('contract') is-invalid @enderror">
                                @error('contract')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="nda" class="form-label app-text-primary">NDA</label>
                                <input type="file" wire:model.defer="nda" id="nda" class="form-control @error('nda') is-invalid @enderror">
                                @error('nda')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="quotation_id" class="form-label app-text-primary">Quotation ID (optional)</label>
                                <input type="text" wire:model.defer="quotation_id" id="quotation_id" class="form-control @error('quotation_id') is-invalid @enderror" placeholder="Enter quotation ID">
                                @error('quotation_id')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="sprint_duration_days" class="form-label app-text-primary">Sprint Duration (days)</label>
                                <input type="number" wire:model.defer="sprint_duration_days" id="sprint_duration_days" class="form-control @error('sprint_duration_days') is-invalid @enderror" min="0" placeholder="Enter sprint duration">
                                @error('sprint_duration_days')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="hosting_and_domain_fee" class="form-label app-text-primary">Hosting &amp; Domain Fee</label>
                                <input type="number" step="0.01" wire:model.defer="hosting_and_domain_fee" id="hosting_and_domain_fee" class="form-control @error('hosting_and_domain_fee') is-invalid @enderror" min="0" placeholder="e.g. 99.99">
                                @error('hosting_and_domain_fee')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-12 d-flex gap-3 flex-wrap">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" wire:model.defer="has_whatsapp_integration" id="has_whatsapp_integration">
                                    <label class="form-check-label app-text-primary" for="has_whatsapp_integration">WhatsApp Integration</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" wire:model.defer="has_ai_integration" id="has_ai_integration">
                                    <label class="form-check-label app-text-primary" for="has_ai_integration">AI Integration</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" wire:model.defer="has_payments_integration" id="has_payments_integration">
                                    <label class="form-check-label app-text-primary" for="has_payments_integration">Payments Integration</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" wire:model.defer="has_other_third_party_integrations" id="has_other_third_party_integrations">
                                    <label class="form-check-label app-text-primary" for="has_other_third_party_integrations">Other Third-Party Integrations</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="maintenance_type" class="form-label app-text-primary">Maintenance Type</label>
                                <select wire:model.defer="maintenance_type" id="maintenance_type" class="form-select @error('maintenance_type') is-invalid @enderror">
                                    <option value="">Select maintenance type</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="on_call">On Call</option>
                                </select>
                                @error('maintenance_type')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="maintenance_fee_monthly" class="form-label app-text-primary">Maintenance Fee (Monthly)</label>
                                <input type="number" step="0.01" wire:model.defer="maintenance_fee_monthly" id="maintenance_fee_monthly" class="form-control @error('maintenance_fee_monthly') is-invalid @enderror" min="0" placeholder="e.g. 100.00">
                                @error('maintenance_fee_monthly')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="billing_type" class="form-label app-text-primary">Billing Type</label>
                                <select wire:model.defer="billing_type" id="billing_type" class="form-select @error('billing_type') is-invalid @enderror">
                                    <option value="">Select billing type</option>
                                    <option value="milestone">Milestone</option>
                                    <option value="fortnightly">Fortnightly</option>
                                </select>
                                @error('billing_type')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="amount" class="form-label app-text-primary">Amount</label>
                                <input type="number" step="0.01" wire:model.defer="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" min="0" placeholder="e.g. 1000.00">
                                @error('amount')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="paid" class="form-label app-text-primary">Paid</label>
                                <input type="number" step="0.01" wire:model.defer="paid" id="paid" class="form-control @error('paid') is-invalid @enderror" min="0" placeholder="e.g. 200.00">
                                @error('paid')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="balance" class="form-label app-text-primary">Balance</label>
                                <input type="number" step="0.01" wire:model.defer="balance" id="balance" class="form-control @error('balance') is-invalid @enderror" min="0" placeholder="e.g. 800.00">
                                @error('balance')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="currency" class="form-label app-text-primary">Currency</label>
                                <input type="text" wire:model.defer="currency" id="currency" class="form-control @error('currency') is-invalid @enderror" maxlength="10" placeholder="e.g. USD">
                                @error('currency')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary app-text-primary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit"
                                class="btn btn-primary app-text-primary"
                                wire:loading.attr="disabled"
                                wire:target="create_project_version"
                        >
                            <span wire:loading.remove wire:target="create_project_version" class="app-text-primary">Create Project Version</span>
                            <span wire:loading wire:target="create_project_version">
                                <span class="spinner-border spinner-border-sm align-middle me-1" role="status" aria-hidden="true"></span>
                                <span class="app-text-primary">Saving...</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Show create project version modal when event dispatched
            window.addEventListener('view-create-project-version-modal', () => {
                var modal = new bootstrap.Modal(document.getElementById('createProjectVersionModal'));
                modal.show();
            });
            window.addEventListener('project-version-created-successfully', () => {
                var modalEl = document.getElementById('createProjectVersionModal');
                var modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();

                // Show success notification using Notyf
                const notyf = new Notyf({
                    duration: 3000,
                    position: { x: 'right', y: 'top' }
                });
                notyf.success('Project version created successfully');
            });
        </script>
    </div>
</div>

