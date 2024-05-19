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
    * {

    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    background-image: url(" ");
    }
    body {

    display: flex;
    justify-content: center;
    align-items: center;
    background: url('./img/frieren.jpeg');
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    height: 100vh;
    }
    .login-form, .registration-form {
        backdrop-filter: blur (100px);
        color: rgb(4, 4, 4);
        background-color: rgb(244, 244, 244);
        padding: 40px;
        width: 500px;
        border: 5px solid;
        border-radius: 10px;
        background-image: url("");
        opacity: 90%;
        
    }   

    .switch-form-link {
        text-decoration: underline;
        cursor: pointer;
        color: rgb(173, 8, 11);
    }
</style>
</head>
<body>
    <div class="main">
    <form action="./endpoint/login.php" method="POST">
        <div class="login-form" id="loginForm">
            <h2 class="text-center">Login</h2>
            <div class="form-group">
                <label for="username">Username: </label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <p>No account? <span class="switch-form-link" onclick="showRegistrationForm()">Register here</span></p>
            <button type="submit" class="btn btn-secondary login-btn form-control">Login</button>
        </div>
    </form>
    <!-- Design naman tayo ng Registration Area --> 
    <div class="registration-form" id="registrationForm">  
        <h2 class="text-center">Register here</h2> 
        <p class="text-center">Fill in your personal details.</p>
        <form action="./endpoint/add-user.php" method="POST">
            <div class="form-group registration row"> 
                <div class="col-6"> 
                    <label for="firstName">First Name: </label> 
                    <input type="text" class="form-control" id="firstName" name="first_name"> 
                </div> 
                <div class="col-6"> 
                    <label for="lastName">Last Name: </label> 
                    <input type="text" class="form-control" id="lastName" name="last_name"> 
                </div> 
            </div> 
            <div class="form-group registration row"> 
                <div class="col-5"> 
                    <label for="contactNumber">Contact Number: </label> 
                    <input type="number" class="form-control" id="contactNumber" name="contact_number" maxlength="11"> 
                </div> 
                <div class="col-7"> 
                    <label for="email">Email: </label> 
                    <input type="text" class="form-control" id="email" name="email"> 
                </div> 
            </div>
             <div class="form-group registration"> 
                <label for="registerUsername">Username: </label> 
                <input type="text" class="form-control" id="registerUsername" name="username"> 
            </div> 
            <div class="form-group registration"> 
                <label for="registerPassword">Password: </label> 
                <input type="password" class="form-control" id="registerPassword" name="password">
             </div> 
             <p>Have account already? <span class="switch-form-link" onclick="showLoginForm()"> Login here.</span></p> 
             <button type="submit" class="btn btn-dark login-register form-control" name="register">Register </button>
        </form> 
            </div> 
        </div>
    </div>
<script>
    const loginForm = document.getElementById('loginForm');
    const registrationForm = document.getElementById('registrationForm');
    registrationForm.style.display = "none";

    function showRegistrationForm() {
    registrationForm.style.display = "";
    loginForm.style.display = "none";
}
    function showLoginForm() {
    registrationForm.style.display = "none";
    loginForm.style.display = "";
}
    function sendVerificationCode() {
        const registrationElements = document.querySelectorAll('.registration');
        registrationElements.forEach(element => {
            element.style.display = 'none';
        });
        const verification = document.querySelector('.verification');
        if (verification) {
            verification.style.display = 'none';
        }
    } 
</script>
</body>
</html>