<div>
    <div class="container-fluid p-0" style="margin-top: -18px;">
        <!-- Create Enrollment Modal -->
        <div wire:ignore.self class="modal fade" id="createEnrollmentModal" tabindex="-1" aria-labelledby="createEnrollmentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form wire:submit.prevent="create_enrollment" class="modal-content app-card">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title app-text-primary" id="createEnrollmentModalLabel">Create New Enrollment</h5>
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
                                <select wire:model.defer="student_id" id="student_id" class="form-select @error('student_id') is-invalid @enderror select2-search">
                                    <option value="">Select student</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">
                                            {{ $student->user->fullname }} (ID: {{ $student->student_number ?? $student->id }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('student_id')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Course Select --}}
                            <div class="col-md-6">
                                <label for="course_id" class="form-label app-text-primary">Course</label>
                                <select wire:model.defer="course_id" id="course_id" class="form-select @error('course_id') is-invalid @enderror select2-search">
                                    <option value="">Select course</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('course_id')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Intake Select --}}
                            <div class="col-md-6">
                                <label for="intake_id" class="form-label app-text-primary">Intake</label>
                                <select wire:model.defer="intake_id" id="intake_id" class="form-select @error('intake_id') is-invalid @enderror select2-search">
                                    <option value="">Select intake</option>
                                    @foreach($intakes as $intake)
                                        <option value="{{ $intake->id }}">
                                            {{ $intake->cohort }}
                                        </option>
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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary app-text-primary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit"
                                class="btn btn-primary app-text-primary"
                                wire:loading.attr="disabled"
                                wire:target="create_enrollment"
                        >
                            <span wire:loading.remove wire:target="create_enrollment" class="app-text-primary">Create Enrollment</span>
                            <span wire:loading wire:target="create_enrollment">
                                <span class="spinner-border spinner-border-sm align-middle me-1" role="status" aria-hidden="true"></span>
                                <span class="app-text-primary">Saving...</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Show create enrollment modal when event dispatched
            window.addEventListener('view-create-enrollment-modal', () => {
                var modal = new bootstrap.Modal(document.getElementById('createEnrollmentModal'));
                modal.show();
            });
            window.addEventListener('enrollment-created-successfully', () => {
                var modalEl = document.getElementById('createEnrollmentModal');
                var modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();

                // Show success notification using Notyf
                const notyf = new Notyf({
                    duration: 3000,
                    position: { x: 'right', y: 'top' }
                });
                notyf.success('Enrollment created successfully');
            });

            // Enable select2 on relevant select boxes for search
            document.addEventListener('livewire:navigated', function () {
                $('.select2-search').select2({
                    dropdownParent: $('#createEnrollmentModal'),
                    theme: 'bootstrap-5',
                    width: '100%'
                }).on('change', function (e) {
                    let model = $(this).attr('wire:model.defer');
                    if (!model) {
                        model = $(this).attr('wire:model');
                    }
                    if (model) {
                        @this.set(model, $(this).val());
                    }
                });
            });
        </script>
    </div>
</div>
