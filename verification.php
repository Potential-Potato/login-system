<?php
include ('./conn/conn.php');
session_start();
if (isset($_SESSION['user_verification_id'])) {
$userVerificationID = $_SESSION['user_verification_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
@import
* {
margin: 0;
padding: 0;
font-family: 'Poppins', sans-serif;
}
body {
display: flex;
justify-content: center;
align-items: center;
background-image: url("https://images7.alphacoders.com/134/1343992.jpeg");
background-size: cover;
background-repeat: no-repeat;
background-attachment: fixed;
height: 100vh;
}
.verification-form {
backdrop-filter: blur(100px);
color: rgb(0, 0, 0);
padding: 40px;
width: 500px;
border: 2px solid;
border-radius: 10px;
}
</style>
</head>
<body>

<div class="main">
    <!-- Email Verification Form to ha -->
    <div class="verification-container">
        <div class="verification-form" id="loginForm">
            <h2 class="text-center">Email Verification</h2>
            <p class="text-center">Please check your email for verification code.</p>
            <form action="./endpoint/add-user.php" method="POST">
                <input type="text" name="user_verification_id" value="<?= $userVerificationID ?>" hidden>
                <input type="number" class="form-control text-center" id="verificationCode"
                name="verification_code">
                <button type="submit" class="btn btn-secondary login-btn form-control mt-4"
                name="verify">Verify</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>