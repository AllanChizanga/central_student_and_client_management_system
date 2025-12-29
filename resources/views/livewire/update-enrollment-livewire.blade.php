<div>
    <div class="container-fluid p-0" style="margin-top: -18px;">
        <!-- Update Enrollment Modal -->
        <div wire:ignore.self class="modal fade" id="updateEnrollmentModal" tabindex="-1" aria-labelledby="updateEnrollmentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form wire:submit.prevent="update_enrollment" class="modal-content app-card">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title app-text-primary" id="updateEnrollmentModalLabel">Update Enrollment</h5>
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

                            {{-- Student Select --}}
                            <div class="col-md-6">
                                <label for="student_id" class="form-label app-text-primary">Student</label>
                                <select wire:model.defer="student_id" id="student_id" class="form-select @error('student_id') is-invalid @enderror">
                                    <option value="">Select student</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                                @error('student_id')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Course Select --}}
                            <div class="col-md-6">
                                <label for="course_id" class="form-label app-text-primary">Course</label>
                                <select wire:model.defer="course_id" id="course_id" class="form-select @error('course_id') is-invalid @enderror">
                                    <option value="">Select course</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                                @error('course_id')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Intake Select --}}
                            <div class="col-md-6">
                                <label for="intake_id" class="form-label app-text-primary">Intake</label>
                                <select wire:model.defer="intake_id" id="intake_id" class="form-select @error('intake_id') is-invalid @enderror">
                                    <option value="">Select intake</option>
                                    @foreach($intakes as $intake)
                                        <option value="{{ $intake->id }}">{{ $intake->cohort }}</option>
                                    @endforeach
                                </select>
                                @error('intake_id')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Enrollment Date --}}
                            <div class="col-md-6">
                                <label for="enrollment_date" class="form-label app-text-primary">Enrollment Date</label>
                                <input type="date" wire:model.defer="enrollment_date" id="enrollment_date" class="form-control @error('enrollment_date') is-invalid @enderror">
                                @error('enrollment_date')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Status Select --}}
                            <div class="col-md-6">
                                <label for="status" class="form-label app-text-primary">Status</label>
                                <select wire:model.defer="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="">Select status</option>
                                    <option value="enrolled">Enrolled</option>
                                    <option value="dropped">Dropped</option>
                                    <option value="graduated">Graduated</option>
                                </select>
                                @error('status')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Amount --}}
                            <div class="col-md-6">
                                <label for="amount" class="form-label app-text-primary">Amount</label>
                                <input type="number" wire:model.defer="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" step="0.01" min="0">
                                @error('amount')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Paid --}}
                            <div class="col-md-6">
                                <label for="paid" class="form-label app-text-primary">Paid</label>
                                <input type="number" wire:model.defer="paid" id="paid" class="form-control @error('paid') is-invalid @enderror" step="0.01" min="0">
                                @error('paid')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Balance --}}
                            <div class="col-md-6">
                                <label for="balance" class="form-label app-text-primary">Balance</label>
                                <input type="number" wire:model.defer="balance" id="balance" class="form-control @error('balance') is-invalid @enderror" step="0.01" min="0">
                                @error('balance')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Currency --}}
                            <div class="col-md-6">
                                <label for="currency" class="form-label app-text-primary">Currency</label>
                                <input type="text" wire:model.defer="currency" id="currency" class="form-control @error('currency') is-invalid @enderror" placeholder="USD, EUR, etc">
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
                                wire:target="update_enrollment"
                        >
                            <span wire:loading.remove wire:target="update_enrollment" class="app-text-primary">Update Enrollment</span>
                            <span wire:loading wire:target="update_enrollment">
                                <span class="spinner-border spinner-border-sm align-middle me-1" role="status" aria-hidden="true"></span>
                                <span class="app-text-primary">Saving...</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Show update enrollment modal when event dispatched
            window.addEventListener('view-update-enrollment-modal', () => {
                var modal = new bootstrap.Modal(document.getElementById('updateEnrollmentModal'));
                modal.show();
            });
            window.addEventListener('enrollment-updated-successfully', () => {
                var modalEl = document.getElementById('updateEnrollmentModal');
                var modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();

                // Show success notification using Notyf
                const notyf = new Notyf({
                    duration: 3000,
                    position: { x: 'right', y: 'top' }
                });
                notyf.success('Enrollment updated successfully');
            });

        window.addEventListener('not-authorized', () => {
            // Optionally close the modal if it's open
            var modalEl = document.getElementById('updateEnrollmentModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            // Show error notification using Notyf
            const notyf = new Notyf({
                duration: 3000,
                position: { x: 'right', y: 'top' }
            });
            notyf.error('You are not authorized to perform this action. Haunyare here iwe !');
        });
        </script>
    </div>
</div>
