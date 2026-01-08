<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Quotation - Zomac Digital</title>
    <style>
        @page {
            size: A4;
            margin: 32px 40px 36px 40px;
        }
        html, body {
            height: 100%;
            width: 100%;
            background: #f8f8fa;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #22223b;
            background: #f8f8fa;
        }
        .container {
            max-width: 820px;
            margin: 32px auto;
            background: #fff;
            border-radius: 16px;
            padding: 40px 36px 40px 36px;
            box-shadow: 0 6px 24px rgba(56, 46, 140, 0.13);
        }
        /* Improved Letterhead */
        .letterhead-row {
            display: flex;
            align-items: center;
            min-height: 70px;
            margin-bottom: 26px;
            border-bottom: 4px solid #a54df8;
            padding-bottom: 10px;
            /* Visually group with the main content */
        }
        .letterhead-logo {
            flex: 0 0 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .letterhead-logo img {
            height: 52px;
            width: auto;
            display: block;
        }
        .letterhead-info {
            flex: 1;
            margin-left: 24px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .company-name {
            font-size: 1.45rem;
            font-weight: bold;
            color: #741cc8;
            letter-spacing: 1.2px;
        }
        .contacts {
            color: #423e5e;
            font-size: 0.99rem;
            margin-top: 1.5px;
        }
        .company-address {
            font-size: 0.96rem;
            color: #7e7b8a;
            margin-top: 2px;
        }
        .quotation-title {
            font-size: 2.05rem;
            font-weight: bold;
            color: #2a2e45;
            letter-spacing: 2px;
            margin-top: 18px;
            margin-bottom: 16px;
            padding-bottom: 4px;
        }
        .section {
            margin-bottom: 28px;
        }
        .label {
            font-weight: bold;
            color: #403e3e;
        }
        .table-responsive {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 1.03rem;
            background: #f9fbff;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 10px;
            margin-bottom: 18px;
            table-layout: auto;
            word-break: break-word;
        }
        th, td {
            padding: 13px 10px;
            border-bottom: 1px solid #e1e7ef;
            word-break: break-word;
        }
        th {
            background-color: #eef1f8;
            color: #353766;
            font-weight: bold;
            text-align: left;
        }
        tr:last-child td {
            border-bottom: none;
        }
        .amount {
            color: #20916e;
            font-weight: bold;
        }
        .summary {
            margin-top: 24px;
            display: flex;
            justify-content: flex-end;
        }
        .summary-box {
            background: #eaf8f0;
            padding: 19px 32px 17px 32px;
            border-radius: 12px;
        }
        .summary-label {
            font-size: 1.15rem;
            color: #305858;
            margin-right: 12px;
        }
        .total {
            font-size: 1.28rem;
            font-weight: bold;
            color: #1d7c5a;
        }
        .footer {
            margin-top: 36px;
            border-top: 1.5px solid #e2e2e2;
            padding-top: 18px;
            font-size: 0.95rem;
            color: #697184;
            text-align: center;
        }
        .badge {
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 0.92rem;
            display: inline-block;
        }
        .badge-success { background: #e4faeb; color: #09834a; }
        .badge-warning { background: #fff6e0; color: #c47c00; }
        .badge-danger  { background: #ffeaea; color: #d32f2f; }
        .badge-unknown { background: #e0e2ee; color: #5a6372; }
        @media print {
            html, body {
                width: 210mm;
                height: 297mm;
                background: #f8f8fa !important;
            }
            .container {
                box-shadow: none !important;
            }
            .letterhead-row {
                border-bottom-width: 3px;
            }
        }
    </style>
</head>
<body>
<div class="container">

    <!-- Letterhead Start (horizontal, non-overlapping) -->
    <div class="letterhead-row">
        <div class="letterhead-logo">
            <img src="assets/images/logos/logo.png" alt="Zomac Digital Logo">
        </div>
        <div class="letterhead-info">
            <span class="company-name">Zomac Digital</span>
            <span class="contacts">
                www.zomacdigital.co.zw &nbsp;|&nbsp; zomac.agency@gmail.com
            </span>
            <span class="company-address">
                82 Rezende St, Harare
            </span>
        </div>
    </div>
    <!-- Letterhead End -->

    <div class="quotation-title">Quotation</div>

    <!-- Project & Client Info -->
    <div class="section" style="display:flex; gap:48px;">
        <div style="flex:1;">
            <span class="label">Client</span><br>
            <b>{{ $project_version->client->company_name ?? 'N/A' }}</b><br>
            <span>{{ $project_version->client->address ?? '-' }}</span><br>
            <span>{{ $project_version->client->country ?? '' }}{{ $project_version->client->city ? ', ' . $project_version->client->city : '' }}</span>
        </div>
        <div style="flex:1;">
            <span class="label">Project</span><br>
            <b>{{ $project_version->project_version_name ?? '-' }}</b><br>
            <span>Version: {{ $project_version->version_number ?? '-' }}</span><br>
            <span>Start Date: {{ $project_version->start_date ? $project_version->start_date->format('d M, Y') : '-' }}</span><br>
            <span>End Date: {{ $project_version->end_date ? $project_version->end_date->format('d M, Y') : '-' }}</span>
        </div>
    </div>

    <div class="section" style="margin-bottom: 8px;">
        <span class="label">Quotation Date:</span>
        <span>{{ now()->format('d M, Y') }}</span>
    </div>

    <!-- Milestones Table -->
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Milestone Title</th>
                    <th>Duration (days)</th>
                    <th>Amount ({{ $project_version->currency ?? 'NGN' }})</th>
                    <th>Payment Status</th>
                    <th>Due Date</th>
                </tr>
            </thead>
            <tbody>
                @php $total_amount = 0; @endphp
                @forelse($milestones as $idx => $milestone)
                    @php $total_amount += $milestone->amount ?? 0; @endphp
                    <tr>
                        <td>{{ $idx + 1 }}</td>
                        <td>{{ $milestone->title ?? '-' }}</td>
                        <td>{{ $milestone->duration_days ?? '-' }}</td>
                        <td class="amount">{{ number_format($milestone->amount ?? 0, 2) }}</td>
                        <td>
                            @php
                                $status = strtolower($milestone->payment_status ?? 'unknown');
                                $badgeClass = match ($status) {
                                    'paid' => 'badge-success',
                                    'pending' => 'badge-warning',
                                    'overdue' => 'badge-danger',
                                    default => 'badge-unknown'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                        </td>
                        <td>
                            {{ $milestone->due_date ? (\Illuminate\Support\Carbon::parse($milestone->due_date)->format('d M, Y')) : '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; color:#999;">No project milestones available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Quotation Summary -->
    <div class="summary">
        <div class="summary-box">
            <span class="summary-label">Milestone Subtotal:</span>
            <span class="total">{{ $project_version->currency ?? 'NGN' }} {{ number_format($total_amount, 2) }}</span>
        </div>
    </div>
    @if($project_version->hosting_and_domain_fee && $project_version->hosting_and_domain_fee > 0)
        <div class="summary" style="margin-top:8px;">
            <div class="summary-box" style="background: #f2eafa;">
                <span class="summary-label">+ Hosting &amp; Domain:</span>
                <span class="total" style="color: #7317c5;">
                    {{ $project_version->currency ?? 'NGN' }} {{ number_format($project_version->hosting_and_domain_fee, 2) }}
                </span>
            </div>
        </div>
    @endif
    @if($project_version->maintenance_fee_monthly && $project_version->maintenance_fee_monthly > 0)
        <div class="summary" style="margin-top:8px;">
            <div class="summary-box" style="background: #fffde4;">
                <span class="summary-label">+ Monthly Maintenance:</span>
                <span class="total" style="color: #c4911e;">
                    {{ $project_version->currency ?? 'NGN' }} {{ number_format($project_version->maintenance_fee_monthly, 2) }} <span style="font-size:0.9em;">/month</span>
                </span>
            </div>
        </div>
    @endif

    <!-- Optional: Integrations badges -->
    <div class="section" style="margin-top: 24px;">
        <span class="label">Additional Integrations:</span>
        @if($project_version->has_whatsapp_integration)
            <span class="badge badge-success" style="margin-right:8px;">WhatsApp</span>
        @endif
        @if($project_version->has_ai_integration)
            <span class="badge badge-success" style="margin-right:8px;">AI</span>
        @endif
        @if($project_version->has_payments_integration)
            <span class="badge badge-success" style="margin-right:8px;">Payments</span>
        @endif
        @if($project_version->has_other_third_party_integrations)
            <span class="badge badge-success" style="margin-right:8px;">Other Third Party</span>
        @endif
        @if(
            !$project_version->has_whatsapp_integration &&
            !$project_version->has_ai_integration &&
            !$project_version->has_payments_integration &&
            !$project_version->has_other_third_party_integrations
        )
            <span style="color:#929286;">None</span>
        @endif
    </div>

    <!-- Footer -->
    <div class="footer">
        This quotation is prepared by <strong>Zomac Digital</strong>.<br>
        All prices are valid for 30 days from the date above.<br>
        Thank you for considering us as your digital transformation partner 🚀
    </div>
</div>
</body>
</html>
