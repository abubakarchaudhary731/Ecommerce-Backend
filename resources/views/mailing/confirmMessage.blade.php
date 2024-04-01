<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
</head>
<body>
    <h2>Hello <strong>{{ $details['name'] }}</strong>!</h2>
    <p>Congratulations! You've successfully placed an order with us. Here are the details:</p>
    
    <p><strong>Order Number:</strong> {{ $details['order_number'] }}</p>
    
    <blockquote>
        "Your order has been confirmed. Sit back and relax as we prepare your items for delivery. We estimate that your order will be delivered within one week. Thank you for choosing us!"
    </blockquote>

    <p><b><i>Thank you for shopping with us!</i></b></p>
</body>
</html>
