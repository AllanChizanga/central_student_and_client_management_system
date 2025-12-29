<?php

namespace App\Repositories;

use App\DTOs\IntakeDTO;
use App\Models\Intake;
use InvalidArgumentException;
use Log;
use RuntimeException;
use Throwable;

class IntakeRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create(IntakeDTO $intake_dto)
    {
        try {
            $intake_data = $intake_dto->to_array();
            unset($intake_data['id']);

            $intake = Intake::create($intake_data);

            return $intake;
        } catch (Throwable $e) {
            Log::error('failed_to_create_intake: ' . $e->getMessage(), [
                'intake' => $intake_dto->to_array(),
                'exception' => $e,
            ]);
            return null;
        }
    }  // endof create

    public function update(IntakeDTO $intake_dto)
    {
        try {
            $intake_data = $intake_dto->to_array();

            if (empty($intake_data['id'])) {
                throw new InvalidArgumentException('Intake ID is required for update.');
            }

            $intake = Intake::find($intake_data['id']);

            if (!$intake) {
                throw new RuntimeException('Intake not found for update. ID: ' . $intake_data['id']);
            }

            unset($intake_data['id']);

            $intake->update($intake_data);

            return $intake;
        } catch (Throwable $e) {
            Log::error('failed_to_update_intake: ' . $e->getMessage(), [
                'intake' => $intake_dto->to_array(),
                'exception' => $e,
            ]);
            return null;
        }
    }

    public function fetch_all()
    {
        try {
            return Intake::query()
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (Throwable $e) {
            Log::error('failed_to_fetch_all_intakes: ' . $e->getMessage(), [
                'exception' => $e,
            ]);
            return null;
        }
    }
}
