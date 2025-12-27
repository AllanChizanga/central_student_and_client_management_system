<div>
    <div class="container-fluid p-0" style="margin-top: -18px;">
        <!-- Create Course Modal -->
        <div wire:ignore.self class="modal fade" id="createCourseModal" tabindex="-1" aria-labelledby="createCourseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form wire:submit.prevent="create_course" class="modal-content app-card">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title app-text-primary" id="createCourseModalLabel">Create New Course</h5>
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
                                <label for="name" class="form-label app-text-primary">Course Name</label>
                                <input type="text" wire:model.defer="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter course name">
                                @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="category" class="form-label app-text-primary">Category</label>
                                <select wire:model.defer="category" id="category" class="form-select @error('category') is-invalid @enderror app-text-primary">
                                    <option value="" class="app-text-primary">Select category</option>
                                    <option value="Software Engineering" class="app-text-primary">Software Engineering</option>
                                    <option value="Cybersecurity" class="app-text-primary">Cybersecurity</option>
                                    <option value="Artificial Intelligence" class="app-text-primary">Artificial Intelligence</option>
                                </select>
                                @error('category')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="duration_months" class="form-label app-text-primary">Duration (Months)</label>
                                <input type="number" min="1" wire:model.defer="duration_months" id="duration_months" class="form-control @error('duration_months') is-invalid @enderror" placeholder="Enter duration in months">
                                @error('duration_months')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Hardcoded options from enums --}}
                            <div class="col-md-6">
                                <label for="mode_of_learning" class="form-label app-text-primary">Mode of Learning</label>
                                <select wire:model.defer="mode_of_learning" id="mode_of_learning" class="form-select @error('mode_of_learning') is-invalid @enderror app-text-primary">
                                    <option value="" class="app-text-primary">Select mode</option>
                                    <option value="Evening Online" class="app-text-primary">Evening Online</option>
                                    <option value="Day In Person" class="app-text-primary">Day In Person</option>
                                    <option value="Evening In Person" class="app-text-primary">Evening In Person</option>
                                    <option value="Weekend In Person" class="app-text-primary">Weekend In Person</option>
                                    <option value="Online Self Paced" class="app-text-primary">Online Self Paced</option>
                                </select>
                                @error('mode_of_learning')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="total_fee" class="form-label app-text-primary">Total Fee</label>
                                <input type="number" step="0.01" min="0" wire:model.defer="total_fee" id="total_fee" class="form-control @error('total_fee') is-invalid @enderror" placeholder="Enter total fee">
                                @error('total_fee')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="fee_currency" class="form-label app-text-primary">Fee Currency</label>
                                <select wire:model.defer="fee_currency" id="fee_currency" class="form-select @error('fee_currency') is-invalid @enderror app-text-primary">
                                    <option value="" class="app-text-primary">Select currency</option>
                                    <option value="USD" class="app-text-primary">USD - US Dollar</option>
                                    <option value="ZWL" class="app-text-primary">ZWL - Zimbabwe Dollar</option>
                               
                                </select>
                                @error('fee_currency')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="monthly_fee" class="form-label app-text-primary">Monthly Fee</label>
                                <input type="number" step="0.01" min="0" wire:model.defer="monthly_fee" id="monthly_fee" class="form-control @error('monthly_fee') is-invalid @enderror" placeholder="Enter monthly fee">
                                @error('monthly_fee')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="active" class="form-label app-text-primary">Status</label>
                                <select wire:model.defer="active" id="active" class="form-select @error('active') is-invalid @enderror app-text-primary">
                                    <option value="" class="app-text-primary">Select status</option>
                                    <option value="1" class="app-text-primary">Active</option>
                                    <option value="0" class="app-text-primary">Inactive</option>
                                </select>
                                @error('active')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="syllabus_pdf" class="form-label app-text-primary">Syllabus PDF</label>
                                <input type="file" wire:model.defer="syllabus_pdf" id="syllabus_pdf" class="form-control @error('syllabus_pdf') is-invalid @enderror app-text-primary" accept=".pdf">
                                @error('syllabus_pdf')<small class="text-danger">{{ $message }}</small>@enderror
                                <div wire:loading wire:target="syllabus_pdf" class="small mt-1 app-text-primary">Uploading...</div>
                            </div>

                            <div class="col-md-6">
                                <label for="summary" class="form-label app-text-primary">Summary</label>
                                <textarea wire:model.defer="summary" id="summary" class="form-control @error('summary') is-invalid @enderror" placeholder="Course summary" rows="2"></textarea>
                                @error('summary')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="prerequisites" class="form-label app-text-primary">Prerequisites</label>
                                <textarea wire:model.defer="prerequisites" id="prerequisites" class="form-control @error('prerequisites') is-invalid @enderror" placeholder="Prerequisites" rows="2"></textarea>
                                @error('prerequisites')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="weekly_schedule" class="form-label app-text-primary">Weekly Schedule</label>
                                <textarea wire:model.defer="weekly_schedule" id="weekly_schedule" class="form-control @error('weekly_schedule') is-invalid @enderror" placeholder="Weekly schedule" rows="2"></textarea>
                                @error('weekly_schedule')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="grading" class="form-label app-text-primary">Grading</label>
                                <textarea wire:model.defer="grading" id="grading" class="form-control @error('grading') is-invalid @enderror" placeholder="Grading details" rows="2"></textarea>
                                @error('grading')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="col-md-6">
                                <label for="type_of_assessments" class="form-label app-text-primary">Type of Assessments</label>
                                <textarea wire:model.defer="type_of_assessments" id="type_of_assessments" class="form-control @error('type_of_assessments') is-invalid @enderror" placeholder="Type of assessments" rows="2"></textarea>
                                @error('type_of_assessments')<small class="text-danger">{{ $message }}</small>@enderror
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
                                wire:target="create_course"
                        >
                            <span wire:loading.remove wire:target="create_course" class="app-text-primary">Create Course</span>
                            <span wire:loading wire:target="create_course">
                                <span class="spinner-border spinner-border-sm align-middle me-1" role="status" aria-hidden="true"></span>
                                <span class="app-text-primary">Saving...</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Show create course modal when event dispatched
            window.addEventListener('view-create-course-modal', () => {
                var modal = new bootstrap.Modal(document.getElementById('createCourseModal'));
                modal.show();
            });
            window.addEventListener('course-created-successfully', () => {
                var modalEl = document.getElementById('createCourseModal');
                var modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();

                // Show success notification using Notyf
                const notyf = new Notyf({
                    duration: 3000,
                    position: { x: 'right', y: 'top' }
                });
                notyf.success('Course created successfully');
            });
        </script>
    </div>
</div>
