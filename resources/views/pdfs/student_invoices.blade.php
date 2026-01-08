<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Invoice</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #222; background: #f6f8fb; }
        .header, .client-details, .invoice-details, .footer { margin-bottom: 32px; }
        .header {
            border-bottom: 3px solid #25416b;
            padding-bottom: 12px;
            display: flex;
            align-items: center;
            background: linear-gradient(90deg,#f4fafc 60%,#e4eef6 100%);
            padding-top: 18px;
            padding-left: 32px;
        }
        .logo {
            width: 80px; 
            height: auto;
            margin-right: 32px;
        }
        .company-info {
            text-align: left;
        }
        .invoice-title {
            font-size: 28px;
            color: #25416b;
            letter-spacing: 2px;
            font-weight: bold;
            margin-bottom: 6px;
        }
        .company-info strong { color: #0e253b; font-size: 17px; }
        .company-info span { color: #25416b; font-size: 13px; }
        .details-table, .charges-table { width: 100%; border-collapse: collapse; margin-bottom: 32px; background:#fff; border-radius: 8px; overflow: hidden;}
        .details-table th, .details-table td, .charges-table th, .charges-table td {
            border: 1px solid #d2daee;
            padding: 10px 14px;
            text-align: left;
            font-size: 14px;
        }
        .details-table th, .charges-table th { background: #25416b; color: #fff; }
        .charges-table tr:nth-child(even), .details-table tr:nth-child(even) { background: #f4fafc; }
        .bold { font-weight: bold; }
        .text-right { text-align: right; }
        h4 {
            color: #25416b;
            margin-bottom: 12px;
            letter-spacing: 1px;
            font-size: 20px;
        }
        .footer {
            font-size: 13px;
            color: #7e8794;
            text-align: center;
            border-top: 2px solid #25416b;
            padding-top: 15px;
            background: #f9fbfe;
        }
        .w-50p { width: 50%; }
        .w-35p { width: 35%; }
        .w-65p { width: 65%; }
    </style>
</head>
<body>
    <div class="header">
        <img src="assets/images/logos/logo.png" alt="Zomac Digital Logo" class="logo">
        <div class="company-info">
            <div class="invoice-title">Student Invoice</div>
            <div>
                <strong>Zomac Digital</strong><br>
                <span>www.zomacdigital.co.zw | zomac.agency@gmail.com</span><br>
                <span>82 Rezende St, Harare</span>
            </div>
        </div>
    </div>

    <div class="client-details">
        <table class="details-table">
            <tr>
                <th class="w-35p">Student Name</th>
                <td class="w-65p">
                    {{ optional(optional($enrollment->student)->user)->fullname ?? '-' }}
                </td>
            </tr>
            <tr>
                <th>Student Number</th>
                <td>
                    {{ $enrollment->student->student_number ?? '-' }}
                </td>
            </tr>
            <tr>
                <th>Course</th>
                <td>
                    {{ $enrollment->course->name ?? '-' }}
                </td>
            </tr>
            <tr>
                <th>Intake/Cohort</th>
                <td>
                    {{ $enrollment->intake->cohort ?? '-' }}
                </td>
            </tr>
            <tr>
                <th>Enrollment Status</th>
                <td>
                    {{ \Illuminate\Support\Str::title($enrollment->status ?? '-') }}
                </td>
            </tr>
        </table>
    </div>

    <div class="invoice-details">
        <table class="details-table">
            <tr>
                <th class="w-35p">Enrollment Date</th>
                <td class="w-65p">
                    {{ optional($enrollment->enrollment_date) ? \Carbon\Carbon::parse($enrollment->enrollment_date)->format('d M Y') : '-' }}
                </td>
            </tr>
            <tr>
                <th>Currency</th>
                <td>{{ $enrollment->currency ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div>
        <h4>Summary</h4>
        <table class="charges-table">
            <tr>
                <th class="text-right">Description</th>
                <th class="text-right">Amount ({{ $enrollment->currency ?? '-' }})</th>
            </tr>
            <tr>
                <td>Course Fee</td>
                <td class="text-right">{{ number_format($enrollment->amount ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td class="bold">Paid</td>
                <td class="text-right bold" style="color:#1c8640">{{ number_format($enrollment->paid ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td class="bold">Balance</td>
                <td class="text-right bold" style="color:#e74c3c">{{ number_format($enrollment->balance ?? 0, 2) }}</td>
            </tr>
        </table>
    </div>

    <div>
        <h4>Payment History</h4>
        @if ($enrollment->student_payments && $enrollment->student_payments->count())
        <table class="details-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Amount Paid</th>
                    <th>Payment Method</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($enrollment->student_payments as $i => $payment)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="bold" style="color:#1c8640">{{ number_format($payment->amount_paid ?? 0, 2) }}</td>
                    <td>{{ $payment->payment_method ?? '-' }}</td>
                    <td>
                        {{ optional($payment->created_at)->format('d M Y') ?? '-' }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <p style="color: #999;">No payments recorded yet.</p>
        @endif
    </div>

    <div class="footer">
        Thank you for your business.<br>
        Generated on {{ now()->format('d M Y') }}.
    </div>
</body>
</html>

