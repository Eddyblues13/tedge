<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tradedgepip</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .wrapper {
            width: 100%;
            background-color: #f4f6f9;
            padding: 40px 0;
        }

        .card {
            max-width: 560px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
        }

        .header {
            background: linear-gradient(135deg, #6366f1 0%, #818cf8 100%);
            padding: 32px 40px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            color: #ffffff;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .header p {
            margin: 6px 0 0;
            color: rgba(255, 255, 255, 0.85);
            font-size: 13px;
        }

        .body-content {
            padding: 36px 40px;
        }

        .body-content h2 {
            margin: 0 0 16px;
            color: #1e1b4b;
            font-size: 20px;
            font-weight: 700;
        }

        .body-content p {
            color: #4b5563;
            font-size: 15px;
            line-height: 1.7;
            margin: 0 0 14px;
        }

        .body-content ul {
            color: #4b5563;
            font-size: 15px;
            line-height: 1.7;
            padding-left: 20px;
            margin: 0 0 14px;
        }

        .body-content li {
            margin-bottom: 6px;
        }

        .info-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin: 16px 0;
        }

        .info-row {
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #9ca3af;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .info-value {
            color: #1e1b4b;
            font-size: 15px;
            font-weight: 600;
            margin-top: 2px;
        }

        .highlight-box {
            background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
            border-radius: 10px;
            padding: 24px;
            text-align: center;
            margin: 20px 0;
        }

        .highlight-amount {
            color: #4338ca;
            font-size: 28px;
            font-weight: 700;
            margin: 4px 0;
        }

        .highlight-label {
            color: #6366f1;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .code-box {
            background: #eef2ff;
            border: 2px dashed #6366f1;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
        }

        .code-value {
            color: #4338ca;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 4px;
        }

        .btn {
            display: inline-block;
            background-color: #6366f1;
            color: #ffffff !important;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 8px;
            letter-spacing: 0.5px;
        }

        .badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .badge-deposit {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-withdrawal {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-plan {
            background-color: #e0e7ff;
            color: #3730a3;
        }

        .badge-copy-trade {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-debit {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-credit {
            background-color: #d1fae5;
            color: #065f46;
        }

        .divider {
            height: 1px;
            background: #e5e7eb;
            margin: 24px 0;
        }

        .footer {
            background: #f9fafb;
            padding: 24px 40px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }

        .footer p {
            margin: 0;
            color: #9ca3af;
            font-size: 12px;
            line-height: 1.6;
        }

        .security-tip {
            background: #fffbeb;
            border-left: 3px solid #f59e0b;
            padding: 12px 16px;
            border-radius: 0 8px 8px 0;
            margin: 16px 0;
            font-size: 13px;
            color: #92400e;
        }

        @media only screen and (max-width: 600px) {
            .card {
                margin: 0 16px;
            }

            .header,
            .body-content,
            .footer {
                padding-left: 24px;
                padding-right: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
            <tr>
                <td align="center">
                    <div class="card">
                        <div class="header">
                            <h1>Tradedgepip</h1>
                            <p>Transaction Notification</p>
                        </div>
                        <div class="body-content">
                            <h2>Transaction Notification</h2>
                            <p>Dear {{ $name }},</p>
                            <p>Your account has been <strong>{{ $transactionType }}ed</strong> with the following
                                details:</p>

                            <div class="highlight-box">
                                <div class="highlight-label">Amount</div>
                                <div class="highlight-amount">{{ number_format($amount, 2) }}</div>
                            </div>

                            <div class="info-box">
                                <div class="info-row">
                                    <div class="info-label">Category</div>
                                    <div class="info-value">{{ $transactionCategory }}</div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">Type</div>
                                    <div class="info-value">{{ $transactionType }}</div>
                                </div>
                                <div class="info-row">
                                    <div class="info-label">Date</div>
                                    <div class="info-value">{{ $date }}</div>
                                </div>
                            </div>

                            <p>Thank you for using our service!</p>
                            <div class="divider"></div>
                            <p style="margin-bottom:0;">Kind Regards,<br><strong
                                    style="color:#1e1b4b;">Tradedgepip</strong></p>
                        </div>
                        <div class="footer">
                            <p>&copy; {{ date('Y') }} Tradedgepip. All rights reserved.</p>
                            <p style="margin-top:4px;">This is an automated message &mdash; please do not reply.</p>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>