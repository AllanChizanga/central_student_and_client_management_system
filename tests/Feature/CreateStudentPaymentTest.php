<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Enrollment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Livewire\StudentPaymentLivewire;

class CreateStudentPaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_student_payment_modal_screen_is_opening()
    {
        Livewire::test(StudentPaymentLivewire::class)
            ->assertStatus(200);
    }

    public function test_student_payment_is_recorded_successfully()
    {
        $enrollment = Enrollment::factory()->create([
            'balance' => 1000.00,
            'currency' => 'USD',
        ]);
        $amount_paid = 350.00;
        $payment_method = 'Bank';
        $next_due_date = now()->addDays(30)->format('Y-m-d');

        Livewire::test(StudentPaymentLivewire::class)
            ->set('amount_paid', $amount_paid)
            ->set('payment_method', $payment_method)
            ->set('next_due_date', $next_due_date)
            ->set('enrollment', $enrollment)
            ->call('record_payment');

        $this->assertDatabaseHas('student_payments', [
            'enrollment_id' => $enrollment->id,
            'amount_paid' => $amount_paid,
            'payment_method' => $payment_method,
            'next_due_date' => $next_due_date,
        ]);
    }
}
