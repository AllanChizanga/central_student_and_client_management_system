<div>
    <div class="container-fluid p-0" style="margin-top: -18px;">
        <!-- Create Intake Modal -->
        <div wire:ignore.self class="modal fade" id="createIntakeModal" tabindex="-1" aria-labelledby="createIntakeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form wire:submit.prevent="create_intake" class="modal-content app-card">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title app-text-primary" id="createIntakeModalLabel">Create New Intake</h5>
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

                            <div class="col-md-12">
                                <label for="cohort" class="form-label app-text-primary">Cohort</label>
                                <input type="text" wire:model.defer="cohort" id="cohort" class="form-control @error('cohort') is-invalid @enderror" placeholder="Enter cohort name (e.g., Jan 2024)">
                                @error('cohort')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="start_date" class="form-label app-text-primary">Start Date</label>
                                <input type="date" wire:model.defer="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror">
                                @error('start_date')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="graduation_date" class="form-label app-text-primary">Graduation Date</label>
                                <input type="date" wire:model.defer="graduation_date" id="graduation_date" class="form-control @error('graduation_date') is-invalid @enderror">
                                @error('graduation_date')<small class="text-danger">{{ $message }}</small>@enderror
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
                                wire:target="create_intake"
                        >
                            <span wire:loading.remove wire:target="create_intake" class="app-text-primary">Create Intake</span>
                            <span wire:loading wire:target="create_intake">
                                <span class="spinner-border spinner-border-sm align-middle me-1" role="status" aria-hidden="true"></span>
                                <span class="app-text-primary">Saving...</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Show create intake modal when event dispatched
            window.addEventListener('view-create-intake-modal', () => {
                var modal = new bootstrap.Modal(document.getElementById('createIntakeModal'));
                modal.show();
            });
            window.addEventListener('intake-created-successfully', () => {
                var modalEl = document.getElementById('createIntakeModal');
                var modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();

                // Show success notification using Notyf
                const notyf = new Notyf({
                    duration: 3000,
                    position: { x: 'right', y: 'top' }
                });
                notyf.success('Intake created successfully');
            });
        </script>
    </div>
</div>
