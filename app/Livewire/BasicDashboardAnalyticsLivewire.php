<?php

namespace App\Livewire;

use App\Models\ProjectVersion;
use App\Models\ProjectVersionPayment;
use App\Models\Student;
use App\Models\StudentPayment;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Livewire\Component;

class BasicDashboardAnalyticsLivewire extends Component
{
    public string $studentFilter = 'lifetime';

    public string $courseRevenueFilter = 'lifetime';

    public string $projectVersionFilter = 'lifetime';

    public string $projectRevenueFilter = 'lifetime';

    protected function getDateRange(string $filter): array
    {
        return match ($filter) {
            'yearly' => [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ],
            'monthly' => [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth(),
            ],
            default => [null, null],
        };
    }

    protected function applyCreatedAtFilter(mixed $query, string $filter): mixed
    {
        [$from, $to] = $this->getDateRange($filter);

        if ($from !== null && $to !== null) {
            $query->whereBetween('created_at', [$from, $to]);
        }

        return $query;
    }

    public function getStudentCountProperty(): int
    {
        $query = Student::query();

        $this->applyCreatedAtFilter($query, $this->studentFilter);

        return (int) $query->count();
    }

    public function getCourseRevenueProperty(): float
    {
        $query = StudentPayment::query();

        $this->applyCreatedAtFilter($query, $this->courseRevenueFilter);

        return (float) $query->sum('amount_paid');
    }

    public function getProjectVersionCountProperty(): int
    {
        $query = ProjectVersion::query();

        $this->applyCreatedAtFilter($query, $this->projectVersionFilter);

        return (int) $query->count();
    }

    public function getProjectRevenueProperty(): float
    {
        $query = ProjectVersionPayment::query();

        $this->applyCreatedAtFilter($query, $this->projectRevenueFilter);

        return (float) $query->sum('amount_paid');
    }

    public function setStudentFilter(string $filter): void
    {
        $this->studentFilter = $filter;
    }

    public function setCourseRevenueFilter(string $filter): void
    {
        $this->courseRevenueFilter = $filter;
    }

    public function setProjectVersionFilter(string $filter): void
    {
        $this->projectVersionFilter = $filter;
    }

    public function setProjectRevenueFilter(string $filter): void
    {
        $this->projectRevenueFilter = $filter;
    }

    public function render(): View
    {
        return view('livewire.basic-dashboard-analytics-livewire');
    }
}

