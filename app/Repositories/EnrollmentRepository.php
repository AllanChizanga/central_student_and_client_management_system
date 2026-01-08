<?php

namespace App\Repositories;

use App\DTOs\EnrollmentDTO;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Collection;
use Log;
use Throwable;

class EnrollmentRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // fetchall
    public function fetch_all(): Collection
    {
        try {
            $enrollments = Enrollment::with([
                'course',
                'intake',
                'student.user',
            ])->get();

            return $enrollments->isEmpty() ? new collection() : $enrollments;
        } catch (Throwable $e) {
            Log::error('Failed to fetch enrollments: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return new Collection();
        }
    }  // endof function

    // fetch_one

    public function fetch_one($enrollment_id): ?Enrollment
    {
        try {
            return Enrollment::with([
                'course',
                'intake',
                'student.user',
            ])->find($enrollment_id);
        } catch (Throwable $e) {
            Log::error('Failed to fetch enrollment: ' . $e->getMessage(), [
                'exception' => $e,
                'enrollment_id' => $enrollment_id,
            ]);
            return null;
        }
    }

    // create

    public function create(EnrollmentDTO $enrollment_dto): ?Enrollment
    {
        try {
            $enrollment = Enrollment::create($enrollment_dto->to_array());

            return $enrollment;
        } catch (Throwable $e) {
            Log::error('Failed to create enrollment: ' . $e->getMessage(), [
                'exception' => $e,
                'student_id' => $enrollment_dto->student_id,
                'course_id' => $enrollment_dto->course_id,
            ]);
            return null;
        }
    }

    // update
    public function update(EnrollmentDTO $enrollment_dto): ?Enrollment
    {
        try {
            $enrollment = Enrollment::find($enrollment_dto->id);

            if (!$enrollment) {
                Log::warning('Enrollment not found for update.', [
                    'enrollment_id' => $enrollment_dto->id,
                ]);
                return null;
            }

            $enrollment->fill($enrollment_dto->to_array());
            $enrollment->save();

            $enrollment->load([
                'course',
                'intake',
                'student.user',
            ]);

            return $enrollment;
        } catch (Throwable $e) {
            Log::error('Failed to update enrollment: ' . $e->getMessage(), [
                'exception' => $e,
                'enrollment_id' => $enrollment_dto->id ?? null,
            ]);
            return null;
        }
    }

    public function update_balances(Enrollment $enrollment, float $amount_paid): bool
    {
        try {
            $enrollment->paid += $amount_paid;
            $enrollment->balance = max(
                0,
                $enrollment->amount - $enrollment->paid
            );
            $enrollment->save();

            return true;
        } catch (Throwable $e) {
            Log::error('Failed to update enrollment balances: ' . $e->getMessage(), [
                'exception' => $e,
                'enrollment_id' => $enrollment->id,
                'amount_paid' => $amount_paid,
            ]);
            return false;
        }
    }
}  // endof class
