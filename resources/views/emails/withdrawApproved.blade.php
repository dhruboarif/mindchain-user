<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-color: #2d2d2d;
            font-family: Arial, sans-serif;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }
        .h1{
            font-color: #fffff; 
            color:#ffff;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #1f1f1f;
            padding: 10px 0;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #1f1f1f;
            padding: 10px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="h1">Mindchain</h1>
        </div>
        <div class="content">
            <h2>Withdraw Request Successful</h2>
            <p>Hi {{ $user->user_name }},</p>
            <p>You submitted withdraw request approved.</p>
            <p><strong> Withdraw Details:</strong></p>
            <ul>
                <li>Amount: {{ $data->amount }} </li>
                <li>Wallet_id: {{ $data->wallet_id }} DAYS </li>

            </ul>

            <p>Thank you for staying with us!</p>
            <p>
                <a href="https://my.mindchainwallet.com/" style="color: #ffffff; text-decoration: none; background-color: #1f1f1f; padding: 10px 20px; border-radius: 5px;">View Mindchain</a>
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Your App Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
