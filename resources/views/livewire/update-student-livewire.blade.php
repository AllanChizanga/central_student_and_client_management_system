<div>
    <div class="container-fluid p-0" style="margin-top: -18px;">
        <!-- Update Student Modal -->
        <div wire:ignore.self class="modal fade" id="updateStudentModal" tabindex="-1" aria-labelledby="updateStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form wire:submit.prevent="update" class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="updateStudentModalLabel">Update Student</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="col-md-6">
                                <label for="update_fullname" class="form-label">Full Name</label>
                                <input type="text" wire:model.defer="fullname" id="update_fullname" class="form-control @error('fullname') is-invalid @enderror" placeholder="Enter full name">
                                @error('fullname')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="update_email" class="form-label">Email</label>
                                <input type="email" wire:model.defer="email" id="update_email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email address">
                                @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="update_phonenumber" class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="update-phone-code-prefix">263</span>
                                    <input
                                        type="text"
                                        wire:model.defer="phonenumber"
                                        id="update_phonenumber"
                                        class="form-control @error('phonenumber') is-invalid @enderror"
                                        placeholder="263719203127"
                                        aria-describedby="update-phone-code-prefix"
                                        minlength="12"
                                        maxlength="12"
                                    >
                                </div>
                                @error('phonenumber')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="update_user_type" class="form-label">User Type</label>
                                <select wire:model.defer="user_type" id="update_user_type" class="form-select @error('user_type') is-invalid @enderror">
                                    <option value="">Select type</option>
                                    <option value="student">Student</option>
                                    <option value="client">Client</option>
                                    <option value="lead">Lead</option>
                                </select>
                                @error('user_type')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="update_status" class="form-label">Status</label>
                                <select wire:model.defer="status" id="update_status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="">Select status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="suspended">Suspended</option>
                                </select>
                                @error('status')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="update_enrollment_status" class="form-label">Enrollment Status</label>
                                <select wire:model.defer="enrollment_status" id="update_enrollment_status" class="form-select @error('enrollment_status') is-invalid @enderror">
                                    <option value="">Select enrollment status</option>
                                    <option value="enrolled">Enrolled</option>
                                    <option value="pending">Pending</option>
                                </select>
                                @error('enrollment_status')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="update_admission_date" class="form-label">Admission Date</label>
                                <div class="input-group">
                                    <input type="date"
                                        wire:model.defer="admission_date"
                                        id="update_admission_date"
                                        class="form-control @error('admission_date') is-invalid @enderror"
                                        max="{{ old('graduation_date', $graduation_date ?? '') ?: '' }}"
                                    >
                                    <span class="input-group-text">
                                        <i class="bi bi-calendar"></i>
                                    </span>
                                </div>
                                @error('admission_date')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="update_graduation_date" class="form-label">Graduation Date</label>
                                <div class="input-group">
                                    <input type="date"
                                        wire:model.defer="graduation_date"
                                        id="update_graduation_date"
                                        class="form-control @error('graduation_date') is-invalid @enderror"
                                        min="{{ old('admission_date', $admission_date ?? '') ?: '' }}"
                                    >
                                    <span class="input-group-text">
                                        <i class="bi bi-calendar"></i>
                                    </span>
                                </div>
                                @error('graduation_date')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="update_gender" class="form-label">Gender</label>
                                <select wire:model.defer="gender" id="update_gender" class="form-select @error('gender') is-invalid @enderror">
                                    <option value="">Select gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('gender')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="update_address" class="form-label">Address</label>
                                <input type="text" wire:model.defer="address" id="update_address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter address">
                                @error('address')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="update_city" class="form-label">City</label>
                                <input type="text" wire:model.defer="city" id="update_city" class="form-control @error('city') is-invalid @enderror" placeholder="Enter city">
                                @error('city')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit"
                            class="btn btn-primary d-inline-flex align-items-center"
                            wire:loading.attr="disabled"
                            wire:target="update"
                        >
                            <span
                                wire:loading
                                wire:target="update"
                                class="me-2"
                            >
                                <span class="spinner-border spinner-border-sm align-middle" role="status" aria-hidden="true"></span>
                            </span>
                            <span wire:loading.remove wire:target="update">
                                Update Student
                            </span>
                            <span wire:loading wire:target="update">
                                Saving...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // When the event is dispatched from Livewire, show or hide the modal accordingly
            window.addEventListener('view-update-student-modal', () => {
                var modal = new bootstrap.Modal(document.getElementById('updateStudentModal'));
                modal.show();
            });
            window.addEventListener('student-updated-successfully', () => {
                var modalEl = document.getElementById('updateStudentModal');
                var modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();

                // Show success notification using Notyf
                const notyf = new Notyf({
                    duration: 3000,
                    position: { x: 'right', y: 'top' }
                });
                notyf.success('Student updated successfully');
            });
        window.addEventListener('student-updated-failed', () => {
            const notyf = new Notyf({
                duration: 3000,
                position: { x: 'right', y: 'top' },
                types: [
                    {
                        type: 'error',
                        background: '#dc3545', // Bootstrap "danger" red
                        icon: {
                            className: 'fas fa-times',
                            tagName: 'i',
                            color: '#fff'
                        }
                    }
                ]
            });
            notyf.open({
                type: 'error',
                message: 'Failed to update student.'
            });
        });
        </script>
    </div>
</div>
