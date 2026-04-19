<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>

<button onclick="payNow()">Pay ₹100</button>

<script>
function payNow() {

    fetch('/create-order', { method: 'POST' })
    .then(res => res.json())
    .then(order => {

        var options = {
            "key": "{{ config('services.razorpay.key') }}",
            "amount": order.amount,
            "currency": "INR",
            "order_id": order.id,

            "handler": function (response){

                fetch('/verify-payment', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(response)
                })
                .then(res => res.json())
                .then(data => {
                    alert(data.status);
                });
            }
        };

        var rzp = new Razorpay(options);
        rzp.open();
    });
}
</script>

</body>
</html>