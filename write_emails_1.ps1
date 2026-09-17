$emailsDir = "c:\Users\user\elevate\resources\views\emails"

# ===== 1. welcome.blade.php =====
@"
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome - Tradedgepip</title>
<style>
body { margin: 0; padding: 0; background-color: #f4f6f9; font-family: 'Segoe UI', Arial, sans-serif; -webkit-text-size-adjust: 100%; }
.wrapper { padding: 40px 20px; }
.card { max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); overflow: hidden; }
.header { background: linear-gradient(135deg, #6366f1, #818cf8); padding: 32px 24px; text-align: center; }
.header h1 { margin: 0; color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: -0.3px; }
.header p { margin: 6px 0 0; color: rgba(255,255,255,0.85); font-size: 13px; font-weight: 400; }
.body-content { padding: 36px 40px; color: #4b5563; font-size: 15px; line-height: 1.7; }
.body-content h2 { color: #1e1b4b; font-size: 20px; margin-top: 0; margin-bottom: 16px; }
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
      <p>Welcome Aboard</p>
    </div>
    <div class="body-content">
      {!! `$wMessage !!}
      <p style="margin-top: 32px; margin-bottom: 0;">Kind Regards,<br><strong style="color: #1e1b4b;">Tradedgepip</strong></p>
    </div>
    <div class="footer">
      &copy; {{ date('Y') }} Tradedgepip. All rights reserved.
    </div>
  </div>
</div>
</body>
</html>
"@ | Set-Content -Path "$emailsDir\welcome.blade.php" -Encoding UTF8
Write-Output "1/11 welcome.blade.php written"

# ===== 2. verify.blade.php =====
@"
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Email Verification - Tradedgepip</title>
<style>
body { margin: 0; padding: 0; background-color: #f4f6f9; font-family: 'Segoe UI', Arial, sans-serif; -webkit-text-size-adjust: 100%; }
.wrapper { padding: 40px 20px; }
.card { max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); overflow: hidden; }
.header { background: linear-gradient(135deg, #6366f1, #818cf8); padding: 32px 24px; text-align: center; }
.header h1 { margin: 0; color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: -0.3px; }
.header p { margin: 6px 0 0; color: rgba(255,255,255,0.85); font-size: 13px; font-weight: 400; }
.body-content { padding: 36px 40px; color: #4b5563; font-size: 15px; line-height: 1.7; }
.body-content h2 { color: #1e1b4b; font-size: 20px; margin-top: 0; margin-bottom: 16px; }
.code-box { background: #f0f0ff; border: 2px dashed #6366f1; border-radius: 8px; padding: 20px; text-align: center; margin: 24px 0; }
.code-box span { font-size: 28px; font-weight: 700; color: #6366f1; letter-spacing: 4px; font-family: 'Courier New', monospace; }
.security-tip { background: #fffbeb; border-left: 4px solid #f59e0b; padding: 12px 16px; border-radius: 0 8px 8px 0; margin-top: 24px; font-size: 13px; color: #92400e; }
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
      <p>Email Verification</p>
    </div>
    <div class="body-content">
      <h2>Confirm Your Registration</h2>
      <p>Thank you for registering with Tradedgepip. Please use the activation code below to verify your email address and complete your registration.</p>
      <div class="code-box">
        <span>{{ `$validToken }}</span>
      </div>
      <p>Enter this code on the verification page to activate your account. This code is valid for a limited time.</p>
      <div class="security-tip">
        <strong>Security Tips:</strong><br>
        &bull; Never share your activation code with anyone.<br>
        &bull; Tradedgepip will never ask for your password via email.<br>
        &bull; If you did not create this account, please ignore this email.
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
"@ | Set-Content -Path "$emailsDir\verify.blade.php" -Encoding UTF8
Write-Output "2/11 verify.blade.php written"

# ===== 3. verification.blade.php =====
@"
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verification - Tradedgepip</title>
<style>
body { margin: 0; padding: 0; background-color: #f4f6f9; font-family: 'Segoe UI', Arial, sans-serif; -webkit-text-size-adjust: 100%; }
.wrapper { padding: 40px 20px; }
.card { max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); overflow: hidden; }
.header { background: linear-gradient(135deg, #6366f1, #818cf8); padding: 32px 24px; text-align: center; }
.header h1 { margin: 0; color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: -0.3px; }
.header p { margin: 6px 0 0; color: rgba(255,255,255,0.85); font-size: 13px; font-weight: 400; }
.body-content { padding: 36px 40px; color: #4b5563; font-size: 15px; line-height: 1.7; }
.body-content h2 { color: #1e1b4b; font-size: 20px; margin-top: 0; margin-bottom: 16px; }
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
      <p>Verification</p>
    </div>
    <div class="body-content">
      {!! `$vmessage !!}
      <p style="margin-top: 32px; margin-bottom: 0;">Kind Regards,<br><strong style="color: #1e1b4b;">Tradedgepip</strong></p>
    </div>
    <div class="footer">
      &copy; {{ date('Y') }} Tradedgepip. All rights reserved.
    </div>
  </div>
</div>
</body>
</html>
"@ | Set-Content -Path "$emailsDir\verification.blade.php" -Encoding UTF8
Write-Output "3/11 verification.blade.php written"

# ===== 4. user_mail.blade.php =====
@"
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notification - Tradedgepip</title>
<style>
body { margin: 0; padding: 0; background-color: #f4f6f9; font-family: 'Segoe UI', Arial, sans-serif; -webkit-text-size-adjust: 100%; }
.wrapper { padding: 40px 20px; }
.card { max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); overflow: hidden; }
.header { background: linear-gradient(135deg, #6366f1, #818cf8); padding: 32px 24px; text-align: center; }
.header h1 { margin: 0; color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: -0.3px; }
.header p { margin: 6px 0 0; color: rgba(255,255,255,0.85); font-size: 13px; font-weight: 400; }
.body-content { padding: 36px 40px; color: #4b5563; font-size: 15px; line-height: 1.7; }
.body-content h2 { color: #1e1b4b; font-size: 20px; margin-top: 0; margin-bottom: 16px; }
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
      <p>Notification</p>
    </div>
    <div class="body-content">
      <p style="margin-top: 0;"><strong style="color: #1e1b4b;">Dear User,</strong></p>
      <div>{!! nl2br(e(`$messageBody)) !!}</div>
      <p style="margin-top: 32px; margin-bottom: 0;">Best Regards,<br><strong style="color: #1e1b4b;">Tradedgepip</strong></p>
    </div>
    <div class="footer">
      &copy; {{ date('Y') }} Tradedgepip. All rights reserved.
    </div>
  </div>
</div>
</body>
</html>
"@ | Set-Content -Path "$emailsDir\user_mail.blade.php" -Encoding UTF8
Write-Output "4/11 user_mail.blade.php written"

# ===== 5. user_email.blade.php =====
@"
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ `$subject ?? 'Notification' }} - Tradedgepip</title>
<style>
body { margin: 0; padding: 0; background-color: #f4f6f9; font-family: 'Segoe UI', Arial, sans-serif; -webkit-text-size-adjust: 100%; }
.wrapper { padding: 40px 20px; }
.card { max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); overflow: hidden; }
.header { background: linear-gradient(135deg, #6366f1, #818cf8); padding: 32px 24px; text-align: center; }
.header h1 { margin: 0; color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: -0.3px; }
.header p { margin: 6px 0 0; color: rgba(255,255,255,0.85); font-size: 13px; font-weight: 400; }
.body-content { padding: 36px 40px; color: #4b5563; font-size: 15px; line-height: 1.7; }
.body-content h2 { color: #1e1b4b; font-size: 20px; margin-top: 0; margin-bottom: 16px; }
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
      <p>{{ `$subject ?? 'Notification' }}</p>
    </div>
    <div class="body-content">
      <p style="margin-top: 0;"><strong style="color: #1e1b4b;">{{ `$subject }}</strong></p>
      <div>{!! nl2br(e(`$messageBody)) !!}</div>
      <p style="margin-top: 32px; margin-bottom: 0;">Best Regards,<br><strong style="color: #1e1b4b;">Tradedgepip</strong></p>
    </div>
    <div class="footer">
      &copy; {{ date('Y') }} Tradedgepip. All rights reserved.
    </div>
  </div>
</div>
</body>
</html>
"@ | Set-Content -Path "$emailsDir\user_email.blade.php" -Encoding UTF8
Write-Output "5/11 user_email.blade.php written"

# ===== 6. user.blade.php =====
@"
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ `$subject ?? 'Notification' }} - Tradedgepip</title>
<style>
body { margin: 0; padding: 0; background-color: #f4f6f9; font-family: 'Segoe UI', Arial, sans-serif; -webkit-text-size-adjust: 100%; }
.wrapper { padding: 40px 20px; }
.card { max-width: 560px; margin: 0 auto; background: #ffffff; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); overflow: hidden; }
.header { background: linear-gradient(135deg, #6366f1, #818cf8); padding: 32px 24px; text-align: center; }
.header h1 { margin: 0; color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: -0.3px; }
.header p { margin: 6px 0 0; color: rgba(255,255,255,0.85); font-size: 13px; font-weight: 400; }
.body-content { padding: 36px 40px; color: #4b5563; font-size: 15px; line-height: 1.7; }
.body-content h2 { color: #1e1b4b; font-size: 20px; margin-top: 0; margin-bottom: 16px; }
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
      <p>{{ `$subject ?? 'Notification' }}</p>
    </div>
    <div class="body-content">
      <h2>{{ `$subject }}</h2>
      {!! `$data !!}
      <p style="margin-top: 32px; margin-bottom: 0;">Kind Regards,<br><strong style="color: #1e1b4b;">Tradedgepip</strong></p>
    </div>
    <div class="footer">
      &copy; {{ date('Y') }} Tradedgepip. All rights reserved.
    </div>
  </div>
</div>
</body>
</html>
"@ | Set-Content -Path "$emailsDir\user.blade.php" -Encoding UTF8
Write-Output "6/11 user.blade.php written"

Write-Output "First batch complete (1-6)"
