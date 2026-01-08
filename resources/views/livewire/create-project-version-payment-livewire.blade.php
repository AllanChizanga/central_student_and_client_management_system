<div>
    <div class="container-fluid p-0" style="margin-top: -18px;">
        <!-- Record Payment Modal -->
        <div wire:ignore.self class="modal fade" id="recordProjectVersionPaymentModal" tabindex="-1" aria-labelledby="recordProjectVersionPaymentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form wire:submit.prevent="record_payment" class="modal-content app-card">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title app-text-primary" id="recordProjectVersionPaymentModalLabel">
                            Record Payment
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if(!empty($project_version))
                            <div class="mb-3">
                                <span class="fw-semibold app-text-primary">
                                    Project Version:
                                </span>
                                <span class="ms-2">
                                    {{ $project_version->project_version_name ?? '-' }}
                                </span>
                            </div>
                        @endif
                        <div class="row g-3">

                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show app-text-primary" role="alert">
                                    <small class="text-danger">{{ session('error') }}</small>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="col-md-6">
                                <label for="amount" class="form-label app-text-primary">Amount</label>
                                <input type="number" step="0.01" wire:model.defer="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" min="0" placeholder="e.g. 1000.00">
                                @error('amount')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="payment_method" class="form-label app-text-primary">Payment Method</label>
                                <select wire:model.defer="payment_method" id="payment_method" class="form-select @error('payment_method') is-invalid @enderror">
                                    <option value="">Select Payment Method</option>
                                    <option value="Ecocash">Ecocash</option>
                                    <option value="Bank">Bank</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Innbucks">Innbucks</option>
                                    <option value="Omari">Omari</option>
                                    <option value="Visa">Visa</option>
                                    <option value="Other">Other</option>
                                </select>
                                @error('payment_method')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="next_due_date" class="form-label app-text-primary">Next Due Date</label>
                                <input type="date" wire:model.defer="next_due_date" id="next_due_date" class="form-control @error('next_due_date') is-invalid @enderror">
                                @error('next_due_date')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary app-text-primary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit"
                                class="btn btn-primary app-text-primary d-flex align-items-center gap-2"
                                wire:loading.attr="disabled"
                                wire:target="record_payment"
                        >
                            <span wire:loading wire:target="record_payment">
                                <span class="spinner-border spinner-border-sm align-middle me-1" role="status" aria-hidden="true"></span>
                            </span>
                            <span wire:loading.remove wire:target="record_payment" class="app-text-primary">Save Payment</span>
                            <span wire:loading wire:target="record_payment" class="app-text-primary">Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Show record project version payment modal when event dispatched
            window.addEventListener('view-record-project-version-payment-modal', () => {
                var modal = new bootstrap.Modal(document.getElementById('recordProjectVersionPaymentModal'));
                modal.show();
            });
            window.addEventListener('project-version-payment-recorded-successfully', () => {
                var modalEl = document.getElementById('recordProjectVersionPaymentModal');
                var modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();

                // Show success notification using Notyf
                const notyf = new Notyf({
                    duration: 3000,
                    position: { x: 'right', y: 'top' }
                });
                notyf.success('Project version payment recorded successfully');
            });
        </script>
    </div>
</div>
