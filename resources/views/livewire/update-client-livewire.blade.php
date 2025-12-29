<div>
    <div class="container-fluid p-0" style="margin-top: -18px;">
        <!-- Update Client Modal -->
        <div wire:ignore.self class="modal fade" id="updateClientModal" tabindex="-1" aria-labelledby="updateClientModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form wire:submit.prevent="update_client" class="modal-content app-card">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title app-text-primary" id="updateClientModalLabel">Update Client</h5>
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
                                <label for="company_name" class="form-label app-text-primary">Company Name</label>
                                <input type="text" wire:model.defer="company_name" id="company_name" class="form-control @error('company_name') is-invalid @enderror">
                                @error('company_name')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="industry" class="form-label app-text-primary">Industry</label>
                                <input type="text" wire:model.defer="industry" id="industry" class="form-control @error('industry') is-invalid @enderror">
                                @error('industry')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lifetime_revenue_contribution" class="form-label app-text-primary">Lifetime Revenue ($)</label>
                                <input type="number" step="0.01" wire:model.defer="lifetime_revenue_contribution" id="lifetime_revenue_contribution" class="form-control @error('lifetime_revenue_contribution') is-invalid @enderror" placeholder="0.00" readonly>
                                @error('lifetime_revenue_contribution')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="country" class="form-label app-text-primary">Country</label>
                                <input type="text" wire:model.defer="country" id="country" class="form-control @error('country') is-invalid @enderror">
                                @error('country')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label app-text-primary">City</label>
                                <input type="text" wire:model.defer="city" id="city" class="form-control @error('city') is-invalid @enderror">
                                @error('city')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="occupation" class="form-label app-text-primary">Occupation</label>
                                <input type="text" wire:model.defer="occupation" id="occupation" class="form-control @error('occupation') is-invalid @enderror">
                                @error('occupation')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label app-text-primary">Address</label>
                                <input type="text" wire:model.defer="address" id="address" class="form-control @error('address') is-invalid @enderror">
                                @error('address')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="client_type" class="form-label app-text-primary">Client Type</label>
                                <select wire:model.defer="client_type" id="client_type" class="form-select @error('client_type') is-invalid @enderror">
                                    <option value="">Select type</option>
                                    <option value="individual">Individual</option>
                                    <option value="organization">Organization</option>
                                </select>
                                @error('client_type')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="client_status" class="form-label app-text-primary">Client Status</label>
                                <select wire:model.defer="client_status" id="client_status" class="form-select @error('client_status') is-invalid @enderror" readonly disabled>
                                    <option value="">Select status</option>
                                    <option value="lead">Lead</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('client_status')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Begin additional fields from UpdateClientLivewire --}}
                            <div class="col-md-6">
                                <label for="fullname" class="form-label app-text-primary">Full Name</label>
                                <input type="text" wire:model.defer="fullname" id="fullname" class="form-control @error('fullname') is-invalid @enderror">
                                @error('fullname')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label app-text-primary">Email</label>
                                <input type="email" wire:model.defer="email" id="email" class="form-control @error('email') is-invalid @enderror">
                                @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phonenumber" class="form-label app-text-primary">Phone Number</label>
                                <input type="text" wire:model.defer="phonenumber" id="phonenumber" class="form-control @error('phonenumber') is-invalid @enderror">
                                @error('phonenumber')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="user_type" class="form-label app-text-primary">User Type</label>
                                <select wire:model.defer="user_type" id="user_type" class="form-select @error('user_type') is-invalid @enderror" readonly disabled>
                                    <option value="client" selected>Client</option>
                                </select>
                                @error('user_type')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label app-text-primary">Status</label>
                                <select wire:model.defer="status" id="status" class="form-select @error('status') is-invalid @enderror" readonly disabled>
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="suspended">Suspended</option>
                                </select>
                                @error('status')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            {{-- End additional fields --}}

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary app-text-primary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit"
                                class="btn btn-primary app-text-primary"
                                wire:loading.attr="disabled"
                                wire:target="update_client"
                        >
                            <span wire:loading.remove wire:target="update_client" class="app-text-primary">Update Client</span>
                            <span wire:loading wire:target="update_client">
                                <span class="spinner-border spinner-border-sm align-middle me-1" role="status" aria-hidden="true"></span>
                                <span class="app-text-primary">Saving...</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Show update client modal when event dispatched
            window.addEventListener('view-update-client-modal', () => {
                var modal = new bootstrap.Modal(document.getElementById('updateClientModal'));
                modal.show();
            });
            window.addEventListener('client-updated-successfully', () => {
                var modalEl = document.getElementById('updateClientModal');
                var modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();

                // Show success notification using Notyf
                const notyf = new Notyf({
                    duration: 3000,
                    position: { x: 'right', y: 'top' }
                });
                notyf.success('Client updated successfully');
            });
        </script>
    </div>
</div>
