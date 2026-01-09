<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Quotation</title>
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
        .small-note { font-size: 12px; color: #666; }
    </style>
</head>
<body>
    @php
        $adminFees = config('admin_fees', []);
        $currency = $enrollment->currency
            ?? optional($enrollment->course)->fee_currency
            ?? '-';
    @endphp

    <div class="header">
        <img src="assets/images/logos/logo.png" alt="Zomac Digital Logo" class="logo">
        <div class="company-info">
            <div class="invoice-title">Student Quotation</div>
            <div>
                <strong>Zomac Digital</strong><br>
                <span>www.zomacdigital.co.zw | zomac.agency@gmail.com</span><br>
                <span>82 Rezende St, Harare</span><br>
                <span class="small-note">Quotation Date: {{ now()->format('d M Y') }}</span>
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
                <th>Duration (Months)</th>
                <td>
                    {{ $enrollment->course->duration_months ?? '-' }}
                </td>
            </tr>
            <tr>
                <th>Intake / Cohort</th>
                <td>
                    {{ $enrollment->intake->cohort ?? '-' }}
                </td>
            </tr>
        </table>
    </div>

    <div class="invoice-details">
        <table class="details-table">
            <tr>
                <th>Course Start Date</th>
                <td>
                    {{ optional(optional($enrollment->intake)->start_date) ? \Carbon\Carbon::parse($enrollment->intake->start_date)->format('d M Y') : '-' }}
                </td>
            </tr>
            <tr>
                <th>Expected Graduation Date</th>
                <td>
                    {{ optional(optional($enrollment->intake)->graduation_date) ? \Carbon\Carbon::parse($enrollment->intake->graduation_date)->format('d M Y') : '-' }}
                </td>
            </tr>
            <tr>
                <th>Currency</th>
                <td>{{ $currency }}</td>
            </tr>
        </table>
    </div>

    <div>
        <h4>Course Fee Summary</h4>
        <table class="charges-table">
            <tr>
                <th class="text-right">Description</th>
                <th class="text-right">Amount ({{ $currency }})</th>
            </tr>
            <tr>
                <td>Total Course Fee</td>
                <td class="text-right">
                    {{ number_format(optional($enrollment->course)->total_fee ?? ($enrollment->amount ?? 0), 2) }}
                </td>
            </tr>
            <tr>
                <td>Estimated Monthly Fee</td>
                <td class="text-right">
                    {{ number_format(optional($enrollment->course)->monthly_fee ?? 0, 2) }}
                </td>
            </tr>
        </table>
        <p class="small-note">
            The monthly fee is indicative and assumes payment over the course duration.
            Final payment plans can be tailored during enrollment confirmation.
        </p>
    </div>

    <div>
        <h4>Administrative &amp; Additional Fees</h4>
        <table class="charges-table">
            <tr>
                <th>Description</th>
                <th class="text-right">Amount (USD)</th>
            </tr>
            <tr>
                <td>Graduation Fees</td>
                <td class="text-right">
                    {{ number_format($adminFees['graduation_fees'] ?? 0, 2) }}
                </td>
            </tr>
            <tr>
                <td>Domain &amp; Hosting (where applicable)</td>
                <td class="text-right">
                    {{ number_format($adminFees['domain_hosting'] ?? 0, 2) }}
                </td>
            </tr>
        </table>
        <p class="small-note">
            Administrative fees may be reviewed periodically. Any changes will be communicated in advance.
        </p>
    </div>

    <div>
        <h4>Payment Options</h4>
        <table class="details-table">
            <tr>
                <th>EcoCash</th>
                <td>{{ $adminFees['ecocash'] ?? '-' }}</td>
            </tr>
            <tr>
                <th>Bank</th>
                <td>{{ $adminFees['bank'] ?? '-' }}</td>
            </tr>
            <tr>
                <th>Innbucks</th>
                <td>{{ $adminFees['innbucks'] ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div>
        <h4>Important Notes</h4>
        <table class="details-table">
            <tr>
                <th class="w-35p">Laptop Requirements</th>
                <td class="w-65p">
                    {{ $adminFees['laptop_requirements'] ?? 'Standard laptop capable of handling modern productivity and development tools.' }}
                </td>
            </tr>
            <tr>
                <th>Quotation Validity</th>
                <td>
                    This quotation is valid for 30 days from the date of issue.
                </td>
            </tr>
            <tr>
                <th>Next Steps</th>
                <td>
                    To confirm your place, please proceed with the initial payment using any of the payment methods above
                    and share proof of payment with the Zomac Digital team.
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        We look forward to partnering with you on your learning journey.<br>
        Generated on {{ now()->format('d M Y') }} by the Zomac Digital internal admin system.
    </div>
</body>
</html>

