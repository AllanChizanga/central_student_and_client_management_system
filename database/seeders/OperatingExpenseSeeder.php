<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OperatingExpense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OperatingExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenses = [
            [
                'name' => 'Rent',
                'category' => 'infrastructure',
                'billing_cycle' => 'monthly',
                'vendor' => 'Zexcom',
                'is_active' => true,
                'next_due_date' => now()->addMonth()->startOfMonth()->toDateString(),
                'notes' => 'Monthly office rent payment plus overtime for 2 offices',
                'amount_type' => 'fixed',
                'default_amount' => 510.00,
            ],
            [
                'name' => 'WiFi',
                'category' => 'utilities',
                'billing_cycle' => 'monthly',
                'vendor' => 'StarLink',
                'is_active' => true,
                'next_due_date' => now()->addMonth()->startOfMonth()->toDateString(),
                'notes' => '85 usd plus charges',
                'amount_type' => 'fixed',
                'default_amount' => 90.00,
            ],
            [
                'name' => 'FB Ads Marketing',
                'category' => 'marketing',
                'billing_cycle' => 'monthly',
                'vendor' => 'Facebook',
                'is_active' => true,
                'next_due_date' => now()->addMonth()->startOfMonth()->toDateString(),
                'notes' => 'Fb ads',
                'amount_type' => 'fixed',
                'default_amount' => 150.00,
            ],
            [
                'name' => 'Tax',
                'category' => 'utilities',
                'billing_cycle' => 'yearly',
                'vendor' => 'Zimra',
                'is_active' => true,
                'next_due_date' => now()->addYear()->startOfYear()->toDateString(),
                'notes' => 'Annual business taxes',
                'amount_type' => 'fixed',
                'default_amount' => 30.00,
            ],
            [
                'name' => 'Electricity',
                'category' => 'utilities',
                'billing_cycle' => 'monthly',
                'vendor' => 'Zesa',
                'is_active' => true,
                'next_due_date' => now()->addMonth()->startOfMonth()->toDateString(),
                'notes' => null,
                'amount_type' => 'fixed',
                'default_amount' => 30.00,
            ],
            [
                'name' => 'Stationery',
                'category' => 'infrastructure',
                'billing_cycle' => 'monthly',
                'vendor' => 'any',
                'is_active' => true,
                'next_due_date' => now()->addMonth()->startOfMonth()->toDateString(),
                'notes' => 'Pens, paper, and office materials',
                'amount_type' => 'fixed',
                'default_amount' => 10.00,
            ],
            [
                'name' => 'Commissions',
                'category' => 'staff',
                'billing_cycle' => 'monthly',
                'vendor' => 'Sales Team',
                'is_active' => true,
                'next_due_date' => now()->addMonth()->startOfMonth()->toDateString(),
                'notes' => 'Sales staff commission payouts',
                'amount_type' => 'fixed',
                'default_amount' => 550.00,
            ],
            [
                'name' => 'Salaries',
                'category' => 'staff',
                'billing_cycle' => 'monthly',
                'vendor' => 'Payroll',
                'is_active' => true,
                'next_due_date' => now()->addMonth()->startOfMonth()->toDateString(),
                'notes' => 'Monthly salary payments',
                'amount_type' => 'fixed',
                'default_amount' => 1500.00,
            ],
            [
                'name' => 'Domain and hosting zomadigital.co.zw',
                'category' => 'infrastructure',
                'billing_cycle' => 'yearly',
                'vendor' => 'Zoma Digital',
                'is_active' => true,
                'next_due_date' => now()->addYear()->startOfYear()->toDateString(),
                'notes' => 'Annual domain and hosting fee',
                'amount_type' => 'fixed',
                'default_amount' => 120.00,
            ],
        ];

        foreach ($expenses as $expense) {
            OperatingExpense::create($expense);
        }
    }
}
