<div>
    <div class="container-fluid p-0" style="margin-top: -18px;">
    <!-- Create Student Modal -->
    <div wire:ignore.self class="modal fade" id="createStudentModal" tabindex="-1" aria-labelledby="createStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form wire:submit.prevent="create_user" class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="createStudentModalLabel">Create New Student</h5>
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
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" wire:model.defer="fullname" id="fullname" class="form-control @error('fullname') is-invalid @enderror" placeholder="Enter full name">
                            @error('fullname')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" wire:model.defer="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email address">
                            @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" wire:model.defer="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password" readonly>
                            @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="phonenumber" class="form-label">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text" id="phone-code-prefix">263</span>
                                <input
                                    type="text"
                                    wire:model.defer="phonenumber"
                                    id="phonenumber"
                                    class="form-control @error('phonenumber') is-invalid @enderror"
                                    placeholder="263719203127"
                                    aria-describedby="phone-code-prefix"
                                    minlength="12"
                                    maxlength="12"
                            
                                >
                            </div>
                            @error('phonenumber')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        {{-- REMOVED STUDENT NUMBER FIELD --}}

                        <div class="col-md-6">
                            <label for="user_type" class="form-label">User Type</label>
                            <select wire:model.defer="user_type" id="user_type" class="form-select @error('user_type') is-invalid @enderror">
                                <option value="">Select type</option>
                                <option value="student">Student</option>
                                <option value="client">Client</option>
                                <option value="lead">Lead</option>
                            </select>
                            @error('user_type')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select wire:model.defer="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="">Select status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="suspended">Suspended</option>
                            </select>
                            @error('status')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="enrollment_status" class="form-label">Enrollment Status</label>
                            <select wire:model.defer="enrollment_status" id="enrollment_status" class="form-select @error('enrollment_status') is-invalid @enderror">
                                <option value="">Select enrollment status</option>
                                <option value="enrolled">Enrolled</option>
                                <option value="graduated">Graduated</option>
                                <option value="dropped">Dropped</option>
                            </select>
                            @error('enrollment_status')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <!-- Start New: admission_date and graduation_date grouped and enhanced -->
                        <div class="col-md-6">
                            <label for="admission_date" class="form-label">Admission Date</label>
                            <div class="input-group">
                                <input type="date" 
                                       wire:model.defer="admission_date" 
                                       id="admission_date" 
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
                            <label for="graduation_date" class="form-label">Graduation Date</label>
                            <div class="input-group">
                                <input type="date" 
                                       wire:model.defer="graduation_date" 
                                       id="graduation_date" 
                                       class="form-control @error('graduation_date') is-invalid @enderror" 
                                       min="{{ old('admission_date', $admission_date ?? '') ?: '' }}"
                                >
                                <span class="input-group-text">
                                    <i class="bi bi-calendar"></i>
                                </span>
                            </div>
                            @error('graduation_date')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                        </div>
                        <!-- End New: admission_date and graduation_date grouped and enhanced -->

                        <div class="col-md-6">
                            <label for="gender" class="form-label">Gender</label>
                            <select wire:model.defer="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
                                <option value="">Select gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            @error('gender')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" wire:model.defer="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter address">
                            @error('address')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" wire:model.defer="city" id="city" class="form-control @error('city') is-invalid @enderror" placeholder="Enter city">
                            @error('city')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        {{-- REMOVED USER ID FIELD --}}

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit"
                        class="btn btn-primary"
                        wire:loading.attr="disabled"
                        wire:target="create_user"
                    >
                        <span wire:loading.remove wire:target="create_user">Create Student</span>
                        <span wire:loading wire:target="create_user">
                            <span class="spinner-border spinner-border-sm align-middle me-1" role="status" aria-hidden="true"></span>
                            Saving...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // When the event is dispatched from Livewire, show or hide the modal accordingly
        window.addEventListener('view-create-student-modal', () => {
            var modal = new bootstrap.Modal(document.getElementById('createStudentModal'));
            modal.show();
        });
        window.addEventListener('student-created-successfully', () => {
            var modalEl = document.getElementById('createStudentModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            // Show success notification using Notyf
            const notyf = new Notyf({
                duration: 3000,
                position: { x: 'right', y: 'top' }
            });
            notyf.success('Student created successfully');
        });
    </script>
    </div>
</div>