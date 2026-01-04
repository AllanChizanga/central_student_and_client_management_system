<div>
    <div class="container-fluid p-0" style="margin-top: -18px;">

        <!-- View Project Milestone Modal -->
        <div wire:ignore.self class="modal fade" id="viewProjectMilestoneModal" tabindex="-1" aria-labelledby="viewProjectMilestoneModalLabel" aria-hidden="true">
            <div 
                class="modal-dialog"
                style="width: 75vw; max-width: 75vw; margin-left: 12.5vw; margin-right: 12.5vw;"
            >
                <div class="modal-content app-card">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title app-text-primary" id="viewProjectMilestoneModalLabel">View Project Milestones</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Project Version Info --}}
                        <div class="mb-3 mt-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="fw-semibold text-primary">{{ $project_version->project_version_name ?? '-' }}</span>
                                        <span class="badge bg-secondary">
                                            Version {{ $project_version->version_number ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6 text-end">
                                    <span class="fw-bold text-success">
                                        Total Amount:
                                        @php
                                            $total_amount = $milestones->sum('amount');
                                        @endphp
                                        {{ number_format($total_amount, 2) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 mt-2">
                            <div class="row g-4 align-items-end">
                                <div class="col-12">
                                    <label for="milestone_search" class="form-label mb-1 text-white">Search</label>
                                    <input
                                        type="text"
                                        id="milestone_search"
                                        wire:model.live.debounce.400ms="search"
                                        placeholder="Search by title or deliverables..."
                                        class="form-control shadow-sm py-3 px-4 fs-5"
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 mt-2 text-end">
                            <button
                                type="button"
                                class="btn btn-outline-success"
                                wire:click="download_quotation"
                                wire:loading.attr="disabled"
                                wire:target="download_quotation"
                            >
                                <span wire:loading.remove wire:target="download_quotation">
                                    Download Quotation
                                </span>
                                <span wire:loading wire:target="download_quotation">
                                    <span class="spinner-border spinner-border-sm align-middle me-2" role="status" aria-hidden="true"></span>
                                    Downloading...
                                </span>
                            </button>
                        </div>

                        <div>
                            <div class="row align-items-end">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table p-0 rounded">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Deliverables</th>
                                                    <th scope="col">Duration (days)</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Payment Status</th>
                                                    <th scope="col">Due Date</th>
                                                    <th scope="col">Developer's Notes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($milestones as $index => $milestone)
                                                    <tr>
                                                        <td>{{ $milestones->firstItem() ? $milestones->firstItem() + $index : $index + 1 }}</td>
                                                        <td>{{ $milestone->title ?? '-' }}</td>
                                                        <td>{{ $milestone->deliverables ?? '-' }}</td>
                                                        <td>{{ $milestone->duration_days ?? '-' }}</td>
                                                        <td>
                                                            {{ $milestone->amount !== null ? number_format($milestone->amount, 2) : '0.00' }}
                                                        </td>
                                                        <td>
                                                            <span class="badge
                                                                @if($milestone->payment_status === 'paid') bg-success
                                                                @elseif($milestone->payment_status === 'pending') bg-warning text-dark
                                                                @elseif($milestone->payment_status === 'overdue') bg-danger
                                                                @else bg-muted text-dark
                                                                @endif
                                                            ">
                                                                {{ ucfirst($milestone->payment_status ?? 'unknown') }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            {{ $milestone->due_date ? $milestone->due_date->format('Y-m-d') : '-' }}
                                                        </td>
                                                        <td>
                                                            {{ $milestone->developers_notes ? \Illuminate\Support\Str::limit($milestone->developers_notes, 30) : '-' }}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="text-center text-muted" colspan="8">No project milestones found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-2">
                                        {{ $milestones->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary app-text-primary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Show view project milestone modal when event dispatched
            window.addEventListener('open-view-milestone-modal', () => {
                var modal = new bootstrap.Modal(document.getElementById('viewProjectMilestoneModal'));
                modal.show();
            });
        </script>
    </div>
</div>
