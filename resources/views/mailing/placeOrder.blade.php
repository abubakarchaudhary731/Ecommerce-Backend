<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Order Notification</title>
</head>
<body>
    <h2>Hello Admin,</h2>
    <p>A new order has been placed by <strong>{{ $details['name'] }}</strong>. Here are the details:</p>
    
    <p><strong>Order Number:</strong> {{ $details['order_number'] }}</p>
    <p><strong>Email:</strong> {{ $details['email'] }}</p>
    <p><strong>Total Price:</strong> ${{ $details['total_price'] }}</p>
    
    <blockquote>
        "Please check the store for further details and respond accordingly."
    </blockquote>

    <p><b><i>Thank you for your attention.</i></b></p>
</body>
</html>
