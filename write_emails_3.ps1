$emailsDir = "c:\Users\user\elevate\resources\views\emails"

# ===== 10. admin_detail_updated.blade.php =====
@"
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Account Update - Tradedgepip</title>
<style>
body { margin: 0; padding: 0; background-color: #f4f6f9; font-family: 'Segoe UI', Arial, sans-serif; -webkit-text-size-adjust: 100%; }
.wrapper { padding: 40px 20px; }
.card { max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); overflow: hidden; }
.header { background: linear-gradient(135deg, #6366f1, #818cf8); padding: 32px 24px; text-align: center; }
.header h1 { margin: 0; color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: -0.3px; }
.header p { margin: 6px 0 0; color: rgba(255,255,255,0.85); font-size: 13px; font-weight: 400; }
.body-content { padding: 36px 40px; color: #4b5563; font-size: 15px; line-height: 1.7; }
.body-content h2 { color: #1e1b4b; font-size: 20px; margin-top: 0; margin-bottom: 16px; }
.change-badge { display: inline-block; background: #e0e7ff; color: #3730a3; font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 16px; }
.changes-table { width: 100%; border-collapse: collapse; margin: 20px 0; border-radius: 8px; overflow: hidden; }
.changes-table th { background: #f9fafb; padding: 10px 16px; text-align: left; font-size: 12px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
.changes-table td { padding: 12px 16px; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
.changes-table td:first-child { color: #6b7280; font-weight: 500; }
.changes-table td:last-child { color: #1e1b4b; font-weight: 600; }
.meta-info { background: #f9fafb; border-radius: 8px; padding: 14px 20px; margin: 20px 0; font-size: 13px; }
.meta-info .row { display: flex; justify-content: space-between; padding: 4px 0; }
.meta-info .lbl { color: #9ca3af; }
.meta-info .val { color: #1e1b4b; font-weight: 600; }
.warning-box { background: #fef3c7; border-left: 4px solid #f59e0b; padding: 14px 16px; border-radius: 0 8px 8px 0; margin-top: 24px; font-size: 13px; color: #92400e; }
.footer { background: #f9fafb; padding: 20px 40px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #f0f0f0; }
@media only screen and (max-width: 600px) {
  .body-content { padding: 24px 20px !important; }
  .footer { padding: 16px 20px !important; }
  .wrapper { padding: 20px 10px !important; }
  .meta-info .row { flex-direction: column; }
}
</style>
</head>
<body>
<div class="wrapper">
  <div class="card">
    <div class="header">
      <h1>Tradedgepip</h1>
      <p>Account Update</p>
    </div>
    <div class="body-content">
      <p style="margin-top: 0;"><strong style="color: #1e1b4b;">Dear {{ `$adminName }},</strong></p>
      <p>Your admin account details have been updated. Please review the changes below:</p>
      <span class="change-badge">{{ `$changeType }}</span>
      <table class="changes-table">
        <thead>
          <tr>
            <th>Field</th>
            <th>New Value</th>
          </tr>
        </thead>
        <tbody>
          @foreach(`$changedFields as `$field => `$value)
          <tr>
            <td>{{ `$field }}</td>
            <td>{{ `$value }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="meta-info">
        <div class="row">
          <span class="lbl">Changed By</span>
          <span class="val">{{ `$changedBy }}</span>
        </div>
        <div class="row">
          <span class="lbl">Date</span>
          <span class="val">{{ `$changeDate }}</span>
        </div>
      </div>
      <div class="warning-box">
        <strong>&#9888; Security Notice:</strong> If you did not authorize these changes, please contact the Super Admin immediately to secure your account.
      </div>
      <p style="margin-top: 32px; margin-bottom: 0;">Kind Regards,<br><strong style="color: #1e1b4b;">Tradedgepip</strong></p>
    </div>
    <div class="footer">
      &copy; {{ date('Y') }} Tradedgepip. All rights reserved.
    </div>
  </div>
</div>
</body>
</html>
"@ | Set-Content -Path "$emailsDir\admin_detail_updated.blade.php" -Encoding UTF8
Write-Output "10/11 admin_detail_updated.blade.php written"

# ===== 11. admin_action_notification.blade.php =====
@"
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Alert - Tradedgepip</title>
<style>
body { margin: 0; padding: 0; background-color: #f4f6f9; font-family: 'Segoe UI', Arial, sans-serif; -webkit-text-size-adjust: 100%; }
.wrapper { padding: 40px 20px; }
.card { max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); overflow: hidden; }
.header { background: linear-gradient(135deg, #6366f1, #818cf8); padding: 32px 24px; text-align: center; }
.header h1 { margin: 0; color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: -0.3px; }
.header p { margin: 6px 0 0; color: rgba(255,255,255,0.85); font-size: 13px; font-weight: 400; }
.body-content { padding: 36px 40px; color: #4b5563; font-size: 15px; line-height: 1.7; }
.body-content h2 { color: #1e1b4b; font-size: 20px; margin-top: 0; margin-bottom: 16px; }
.badge-deposit { display: inline-block; background: #d1fae5; color: #065f46; font-size: 12px; font-weight: 700; padding: 5px 14px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; }
.badge-withdrawal { display: inline-block; background: #fee2e2; color: #991b1b; font-size: 12px; font-weight: 700; padding: 5px 14px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; }
.badge-plan { display: inline-block; background: #e0e7ff; color: #3730a3; font-size: 12px; font-weight: 700; padding: 5px 14px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; }
.badge-copy-trade { display: inline-block; background: #fef3c7; color: #92400e; font-size: 12px; font-weight: 700; padding: 5px 14px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; }
.amount-box { background: linear-gradient(135deg, #eef2ff, #e0e7ff); border-radius: 10px; padding: 20px; text-align: center; margin: 20px 0; }
.amount-box .label { font-size: 12px; color: #6366f1; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
.amount-box .value { font-size: 28px; font-weight: 700; color: #1e1b4b; }
.details-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
.details-table td { padding: 12px 16px; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
.details-table td:first-child { color: #9ca3af; font-weight: 500; width: 40%; }
.details-table td:last-child { color: #1e1b4b; font-weight: 600; text-align: right; }
.cta-btn { display: inline-block; background: linear-gradient(135deg, #6366f1, #818cf8); color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 8px; font-size: 14px; font-weight: 600; margin-top: 24px; }
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
      <p>Admin Alert</p>
    </div>
    <div class="body-content">
      <h2>New Action Requires Attention</h2>
      @if(`$actionType === 'Deposit')
        <span class="badge-deposit">{{ `$actionType }}</span>
      @elseif(`$actionType === 'Withdrawal')
        <span class="badge-withdrawal">{{ `$actionType }}</span>
      @elseif(`$actionType === 'Plan Purchase')
        <span class="badge-plan">{{ `$actionType }}</span>
      @elseif(`$actionType === 'Copy Trade')
        <span class="badge-copy-trade">{{ `$actionType }}</span>
      @else
        <span class="badge-plan">{{ `$actionType }}</span>
      @endif

      <div class="amount-box">
        <div class="label">Amount</div>
        <div class="value">{{ number_format(`$amount, 2) }}</div>
      </div>

      <table class="details-table">
        <tr>
          <td>User</td>
          <td>{{ `$userName }}</td>
        </tr>
        <tr>
          <td>Email</td>
          <td>{{ `$userEmail }}</td>
        </tr>
        <tr>
          <td>Date</td>
          <td>{{ `$date }}</td>
        </tr>
        @foreach(`$details as `$label => `$value)
        <tr>
          <td>{{ `$label }}</td>
          <td>{{ `$value }}</td>
        </tr>
        @endforeach
      </table>

      <div style="text-align: center;">
        <a href="{{ url('/admin/dashboard') }}" class="cta-btn" style="color: #ffffff;">Go to Admin Dashboard &rarr;</a>
      </div>

      <p style="margin-top: 32px; margin-bottom: 0;">Kind Regards,<br><strong style="color: #1e1b4b;">Tradedgepip</strong></p>
    </div>
    <div class="footer">
      &copy; {{ date('Y') }} Tradedgepip. All rights reserved.
    </div>
  </div>
</div>
</body>
</html>
"@ | Set-Content -Path "$emailsDir\admin_action_notification.blade.php" -Encoding UTF8
Write-Output "11/11 admin_action_notification.blade.php written"

Write-Output "Third batch complete (10-11). All 11 email templates written!"
