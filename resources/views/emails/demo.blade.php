<!-- resources/views/emails/welcome.blade.php -->
<!DOCTYPE html>
<html>
<body>
    <h2>Welcome, {{ $subject }}! 🎉</h2>
    <p>Your email: {{ $mailMessage }}</p>
    <p>Details: {{ $name }}</p>  
    <p>Product: {{ $product }}</p>  
    <p>Cost: {{ $cost }}</p>  

</body>
</html>