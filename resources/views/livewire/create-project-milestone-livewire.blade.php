<div>
    <div class="container-fluid p-0" style="margin-top: -18px;">
      
        <!-- Create Project Milestone Modal -->
        <div wire:ignore.self class="modal fade" id="createProjectMilestoneModal" tabindex="-1" aria-labelledby="createProjectMilestoneModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form wire:submit.prevent="create_project_milestone" class="modal-content app-card">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title app-text-primary" id="createProjectMilestoneModalLabel">Create New Project Milestone</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        {{-- Display Project Version Name and Number using $project_version --}}
                        @if(isset($project_version) && $project_version)
                            <div class=" mb-3">
                                <div class="fw-semibold">
                                    Project Version:
                                    <span class="ms-1">{{ $project_version->project_version_name ?? 'N/A' }}</span>
                                    @if(!empty($project_version->version_number))
                                        <span class="ms-2 badge bg-secondary">
                                            {{ $project_version->version_number }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Button to View Milestones -->
                        <div class="mb-3">
                            <button type="button"
                                class="btn btn-outline-primary app-text-primary"
                                wire:click="initiate_view_milestone('{{ $project_version_id }}')"
                            >
                                View Milestones
                            </button>
                        </div>
                        <div class="row g-3">
                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show app-text-primary" role="alert">
                                    <small class="text-danger">{{ session('error') }}</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show app-text-primary" role="alert">
                                    <small class="text-success">{{ session('success') }}</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="col-md-12">
                                <label for="title" class="form-label app-text-primary">Milestone Title</label>
                                <input type="text" wire:model.defer="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter milestone title">
                                @error('title')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-12">
                                <label for="deliverables" class="form-label app-text-primary">Deliverables</label>
                                <textarea wire:model.defer="deliverables" id="deliverables" class="form-control @error('deliverables') is-invalid @enderror" rows="3" placeholder="List milestone deliverables"></textarea>
                                @error('deliverables')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="duration_days" class="form-label app-text-primary">Duration (days)</label>
                                <input type="number" wire:model.live="duration_days" id="duration_days" class="form-control @error('duration_days') is-invalid @enderror" placeholder="e.g. 10" min="0">
                                @error('duration_days')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="amount" class="form-label app-text-primary">Amount ($)</label>
                                <input type="number" step="0.01" wire:model.live="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" placeholder="0.00" min="0" readonly>
                                @error('amount')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="payment_status" class="form-label app-text-primary">Payment Status</label>
                                <select wire:model.defer="payment_status" id="payment_status" class="form-select @error('payment_status') is-invalid @enderror">
                                    <option value="">Select status</option>
                                    <option value="pending">Pending</option>
                                    <option value="paid">Paid</option>
                                    <option value="overdue">Overdue</option>
                                </select>
                                @error('payment_status')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="due_date" class="form-label app-text-primary">Due Date</label>
                                <input type="date" wire:model.defer="due_date" id="due_date" class="form-control @error('due_date') is-invalid @enderror">
                                @error('due_date')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-12">
                                <label for="developers_notes" class="form-label app-text-primary">Developer's Notes</label>
                                <textarea wire:model.defer="developers_notes" id="developers_notes" class="form-control @error('developers_notes') is-invalid @enderror" rows="2" placeholder="Add developer's notes"></textarea>
                                @error('developers_notes')<small class="text-danger">{{ $message }}</small>@enderror
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
                                wire:target="create_project_milestone"
                        >
                            <span wire:loading.remove wire:target="create_project_milestone" class="app-text-primary">Create Milestone</span>
                            <span wire:loading wire:target="create_project_milestone">
                                <span class="spinner-border spinner-border-sm align-middle me-1" role="status" aria-hidden="true"></span>
                                <span class="app-text-primary">Saving...</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Show create project milestone modal when event dispatched
            window.addEventListener('view-create-project-milestone-modal', () => {
                var modal = new bootstrap.Modal(document.getElementById('createProjectMilestoneModal'));
                modal.show();
            });
            window.addEventListener('project-milestone-created-successfully', () => {
                var modalEl = document.getElementById('createProjectMilestoneModal');
                var modal = bootstrap.Modal.getInstance(modalEl);
                // if (modal) modal.hide();

                // Show success notification using Notyf
                const notyf = new Notyf({
                    duration: 3000,
                    position: { x: 'right', y: 'top' }
                });
                notyf.success('Milestone created successfully');
            });
        </script>
    </div>
</div>
