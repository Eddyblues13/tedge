$emailsDir = "c:\Users\user\elevate\resources\views\emails"

# ===== 7. transaction_notification.blade.php =====
@"
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Transaction Notification - Tradedgepip</title>
<style>
body { margin: 0; padding: 0; background-color: #f4f6f9; font-family: 'Segoe UI', Arial, sans-serif; -webkit-text-size-adjust: 100%; }
.wrapper { padding: 40px 20px; }
.card { max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); overflow: hidden; }
.header { background: linear-gradient(135deg, #6366f1, #818cf8); padding: 32px 24px; text-align: center; }
.header h1 { margin: 0; color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: -0.3px; }
.header p { margin: 6px 0 0; color: rgba(255,255,255,0.85); font-size: 13px; font-weight: 400; }
.body-content { padding: 36px 40px; color: #4b5563; font-size: 15px; line-height: 1.7; }
.body-content h2 { color: #1e1b4b; font-size: 20px; margin-top: 0; margin-bottom: 16px; }
.details-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
.details-table td { padding: 12px 16px; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
.details-table td:first-child { color: #9ca3af; font-weight: 500; width: 40%; }
.details-table td:last-child { color: #1e1b4b; font-weight: 600; text-align: right; }
.amount-box { background: linear-gradient(135deg, #eef2ff, #e0e7ff); border-radius: 10px; padding: 20px; text-align: center; margin: 20px 0; }
.amount-box .label { font-size: 12px; color: #6366f1; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
.amount-box .value { font-size: 28px; font-weight: 700; color: #1e1b4b; }
.footer { background: #f9fafb; padding: 20px 40px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #f0f0f0; }
@media only screen and (max-width: 600px) {
  .body-content { padding: 24px 20px !important; }
  .footer { padding: 16px 20px !important; }
  .wrapper { padding: 20px 10px !important; }
}
</style>
</head>
<body>
<div class="wrapper">
  <div class="card">
    <div class="header">
      <h1>Tradedgepip</h1>
      <p>Transaction Notification</p>
    </div>
    <div class="body-content">
      <p style="margin-top: 0;"><strong style="color: #1e1b4b;">Dear {{ `$name }},</strong></p>
      <p>A transaction has been processed on your account. Here are the details:</p>
      <div class="amount-box">
        <div class="label">Amount</div>
        <div class="value">{{ number_format(`$amount, 2) }}</div>
      </div>
      <table class="details-table">
        <tr>
          <td>Category</td>
          <td>{{ `$transactionCategory }}</td>
        </tr>
        <tr>
          <td>Type</td>
          <td>{{ `$transactionType }}</td>
        </tr>
        <tr>
          <td>Date</td>
          <td>{{ `$date }}</td>
        </tr>
      </table>
      <p>If you did not authorize this transaction, please contact our support team immediately.</p>
      <p style="margin-top: 32px; margin-bottom: 0;">Kind Regards,<br><strong style="color: #1e1b4b;">Tradedgepip</strong></p>
    </div>
    <div class="footer">
      &copy; {{ date('Y') }} Tradedgepip. All rights reserved.
    </div>
  </div>
</div>
</body>
</html>
"@ | Set-Content -Path "$emailsDir\transaction_notification.blade.php" -Encoding UTF8
Write-Output "7/11 transaction_notification.blade.php written"

# ===== 8. debit_alert.blade.php =====
@"
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Debit Alert - Tradedgepip</title>
<style>
body { margin: 0; padding: 0; background-color: #f4f6f9; font-family: 'Segoe UI', Arial, sans-serif; -webkit-text-size-adjust: 100%; }
.wrapper { padding: 40px 20px; }
.card { max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); overflow: hidden; }
.header { background: linear-gradient(135deg, #6366f1, #818cf8); padding: 32px 24px; text-align: center; }
.header h1 { margin: 0; color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: -0.3px; }
.header p { margin: 6px 0 0; color: rgba(255,255,255,0.85); font-size: 13px; font-weight: 400; }
.body-content { padding: 36px 40px; color: #4b5563; font-size: 15px; line-height: 1.7; }
.body-content h2 { color: #1e1b4b; font-size: 20px; margin-top: 0; margin-bottom: 16px; }
.amount-highlight { background: #fee2e2; border-radius: 10px; padding: 20px; text-align: center; margin: 20px 0; }
.amount-highlight .label { font-size: 12px; color: #991b1b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
.amount-highlight .value { font-size: 28px; font-weight: 700; color: #991b1b; }
.details-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
.details-table td { padding: 12px 16px; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
.details-table td:first-child { color: #9ca3af; font-weight: 500; width: 40%; }
.details-table td:last-child { color: #1e1b4b; font-weight: 600; text-align: right; }
.balance-box { background: #f9fafb; border-radius: 8px; padding: 14px 20px; display: flex; justify-content: space-between; align-items: center; margin-top: 20px; }
.balance-box .lbl { color: #9ca3af; font-size: 13px; }
.balance-box .val { color: #1e1b4b; font-size: 18px; font-weight: 700; }
.footer { background: #f9fafb; padding: 20px 40px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #f0f0f0; }
@media only screen and (max-width: 600px) {
  .body-content { padding: 24px 20px !important; }
  .footer { padding: 16px 20px !important; }
  .wrapper { padding: 20px 10px !important; }
}
</style>
</head>
<body>
<div class="wrapper">
  <div class="card">
    <div class="header">
      <h1>Tradedgepip</h1>
      <p>Debit Alert</p>
    </div>
    <div class="body-content">
      <p style="margin-top: 0;"><strong style="color: #1e1b4b;">Dear {{`$user['full_name']}},</strong></p>
      <p>Your account has been <strong style="color: #991b1b;">Debited</strong>. Please find the transaction details below:</p>
      <div class="amount-highlight">
        <div class="label">Amount Debited</div>
        <div class="value">{{`$user['currency']}} {{`$user['amount']}}</div>
      </div>
      <table class="details-table">
        <tr>
          <td>Account Number</td>
          <td>{{`$user['account_number']}}</td>
        </tr>
        <tr>
          <td>Account Name</td>
          <td>{{`$user['account_name']}}</td>
        </tr>
        <tr>
          <td>Description</td>
          <td>{{`$user['description']}}</td>
        </tr>
        <tr>
          <td>Reference</td>
          <td style="font-family: 'Courier New', monospace; font-size: 13px;">{{`$user['ref']}}</td>
        </tr>
        <tr>
          <td>Date</td>
          <td>{{`$user['date']}}</td>
        </tr>
      </table>
      <div class="balance-box">
        <span class="lbl">Available Balance</span>
        <span class="val">{{`$user['currency']}} {{`$user['balance']}}</span>
      </div>
      <p style="margin-top: 24px; font-size: 13px; color: #6b7280;">If you did not authorize this transaction, please contact our support team immediately.</p>
      <p style="margin-top: 32px; margin-bottom: 0;">Kind Regards,<br><strong style="color: #1e1b4b;">Tradedgepip</strong></p>
    </div>
    <div class="footer">
      &copy; {{ date('Y') }} Tradedgepip. All rights reserved.
    </div>
  </div>
</div>
</body>
</html>
"@ | Set-Content -Path "$emailsDir\debit_alert.blade.php" -Encoding UTF8
Write-Output "8/11 debit_alert.blade.php written"

# ===== 9. credit_alert.blade.php =====
@"
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Credit Alert - Tradedgepip</title>
<style>
body { margin: 0; padding: 0; background-color: #f4f6f9; font-family: 'Segoe UI', Arial, sans-serif; -webkit-text-size-adjust: 100%; }
.wrapper { padding: 40px 20px; }
.card { max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); overflow: hidden; }
.header { background: linear-gradient(135deg, #6366f1, #818cf8); padding: 32px 24px; text-align: center; }
.header h1 { margin: 0; color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: -0.3px; }
.header p { margin: 6px 0 0; color: rgba(255,255,255,0.85); font-size: 13px; font-weight: 400; }
.body-content { padding: 36px 40px; color: #4b5563; font-size: 15px; line-height: 1.7; }
.body-content h2 { color: #1e1b4b; font-size: 20px; margin-top: 0; margin-bottom: 16px; }
.amount-highlight { background: #d1fae5; border-radius: 10px; padding: 20px; text-align: center; margin: 20px 0; }
.amount-highlight .label { font-size: 12px; color: #065f46; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
.amount-highlight .value { font-size: 28px; font-weight: 700; color: #065f46; }
.details-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
.details-table td { padding: 12px 16px; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
.details-table td:first-child { color: #9ca3af; font-weight: 500; width: 40%; }
.details-table td:last-child { color: #1e1b4b; font-weight: 600; text-align: right; }
.balance-box { background: #f9fafb; border-radius: 8px; padding: 14px 20px; display: flex; justify-content: space-between; align-items: center; margin-top: 20px; }
.balance-box .lbl { color: #9ca3af; font-size: 13px; }
.balance-box .val { color: #1e1b4b; font-size: 18px; font-weight: 700; }
.footer { background: #f9fafb; padding: 20px 40px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #f0f0f0; }
@media only screen and (max-width: 600px) {
  .body-content { padding: 24px 20px !important; }
  .footer { padding: 16px 20px !important; }
  .wrapper { padding: 20px 10px !important; }
}
</style>
</head>
<body>
<div class="wrapper">
  <div class="card">
    <div class="header">
      <h1>Tradedgepip</h1>
      <p>Credit Alert</p>
    </div>
    <div class="body-content">
      <p style="margin-top: 0;"><strong style="color: #1e1b4b;">Dear {{`$user['full_name']}},</strong></p>
      <p>Your account has been <strong style="color: #065f46;">Credited</strong>. Please find the transaction details below:</p>
      <div class="amount-highlight">
        <div class="label">Amount Credited</div>
        <div class="value">{{`$user['currency']}} {{`$user['amount']}}</div>
      </div>
      <table class="details-table">
        <tr>
          <td>Account Number</td>
          <td>{{`$user['account_number']}}</td>
        </tr>
        <tr>
          <td>Account Name</td>
          <td>{{`$user['account_name']}}</td>
        </tr>
        <tr>
          <td>Description</td>
          <td>{{`$user['description']}}</td>
        </tr>
        <tr>
          <td>Reference</td>
          <td style="font-family: 'Courier New', monospace; font-size: 13px;">{{`$user['ref']}}</td>
        </tr>
        <tr>
          <td>Date</td>
          <td>{{`$user['date']}}</td>
        </tr>
      </table>
      <div class="balance-box">
        <span class="lbl">Available Balance</span>
        <span class="val">{{`$user['currency']}} {{`$user['balance']}}</span>
      </div>
      <p style="margin-top: 24px; font-size: 13px; color: #6b7280;">If you have any questions about this transaction, please contact our support team.</p>
      <p style="margin-top: 32px; margin-bottom: 0;">Kind Regards,<br><strong style="color: #1e1b4b;">Tradedgepip</strong></p>
    </div>
    <div class="footer">
      &copy; {{ date('Y') }} Tradedgepip. All rights reserved.
    </div>
  </div>
</div>
</body>
</html>
"@ | Set-Content -Path "$emailsDir\credit_alert.blade.php" -Encoding UTF8
Write-Output "9/11 credit_alert.blade.php written"

Write-Output "Second batch complete (7-9)"
