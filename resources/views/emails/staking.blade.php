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
            <h2>Staking Purchase Successful</h2>
            <p>Hi {{ $data['name'] }},</p>
            <p>You have successfully purchased a staking package.</p>
            <p><strong>Staking Details:</strong></p>
            <ul>
                <li>Amount: {{ $data['staking']->amount }} MIND</li>
                <li>Duration: {{ $data['staking']->days }} DAYS </li>
                <li>Total Value: {{ $data['staking']->total_value }} MIND </li>
                <li>Apy Value: {{ $data['staking']->apy_value }} MIND </li>
                <li>Daily Earning: {{ $data['staking']->daily }} MIND</li>


            </ul>
            <p>Thank you for your purchase!</p>
            <p>
                <a href="https://my.mindchainwallet.com/home/staking-history/{{ $data['staking']->user_id }}" style="color: #ffffff; text-decoration: none; background-color: #1f1f1f; padding: 10px 20px; border-radius: 5px;">View Details</a>
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Your App Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
