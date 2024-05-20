<?php
include('./conn/conn.php');

// Fetch all users from the database
try {
    $stmt = $conn->prepare("SELECT * FROM tbl_user");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
            background: url('./img/frieren2.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100vh;
        }

        .table-container {
            position: fixed;
            top: 10rem;
            left: 3rem;
            right: 3rem;
            display: flex;
            flex-direction: column;
            backdrop-filter: blur (100px);
            color: rgb(4, 4, 4);
            background-color: rgb(244, 244, 244);
            opacity: 90%;
            border: 3px solid;
            border-radius: 10px;
        }
        .table-category, .table-items{
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            backdrop-filter: blur (100px);
            color: rgb(4, 4, 4);
            background-color: rgb(244, 244, 244);
            opacity: 90%;
            font-weight: bold;
            align-items: center;
        }

        .table-category p, .table-items div {
            text-align: center;
            padding: 8px;
            border: 1px solid #ccc;
        }

        .registration-form, .update-form {
            backdrop-filter: blur (100px);
            color: rgb(4, 4, 4);
            background-color: rgb(244, 244, 244);
            padding: 40px;
            width: 500px;
            border: 5px solid;
            border-radius: 10px;
            background-image: url("");
            opacity: 98%;
        }   

        .registration-form, .update-form{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .buttons{
            display: flex;
            align-items: space-around;
            justify-content: space-evenly;
        }

        .exit-button{
            position: inherit;
            top: 2rem;
            left: 27rem;
            display: inline-block;
            border: none;
            background: url('./img/exit-button.png') center/cover no-repeat; 
            width: 2rem; 
            height: 2rem; 
            cursor: pointer;
        }

        .exit-button:hover {
            transform: scale(1.1); /* Increase the size on hover */
        }

        .add-button {
            border: none;
            position: fixed;
            top: 7.5rem;
            right: 3.5rem;
            background: url('./img/add-button.png') center/cover no-repeat; 
            width: 2rem; 
            height: 2rem; 
            cursor: pointer;
        }

        .add-button:hover {
            transform: scale(1.1); /* Increase the size on hover */
        }


        .update-button{
            border: none;
            background: url('./img/edit-button.png') center/cover no-repeat; 
            width: 2rem; 
            height: 2rem; 
            cursor: pointer;
        }

        .update-button:hover {
            transform: scale(1.1); /* Increase the size on hover */
        }
   
        .delete-button{
            border: none;
            background: url('./img/delete-button.png') center/cover no-repeat; 
            width: 2rem; 
            height: 2rem; 
            cursor: pointer;
        }

        .delete-button:hover {
            transform: scale(1.1); /* Increase the size on hover */
        }

        h3{
            position:fixed;
            top: 5rem;
            color: rgb(253, 253, 253);
            font-size: 3rem;
            font-weight: bold;
        }

    </style>
</head>
<body>
    <h3>User Accounts</h3>
    <button class="add-button" onclick="showRegistrationForm()"></button>
    <div class="table-container">
        <div class="table-items">
            <div>ID</div>
            <div>First Name</div>
            <div>Last Name</div>
            <div>Contact Number</div>
            <div>Email</div>
            <div>Username</div>
            <div>Actions</div>
            <?php foreach ($users as $user): ?>
                <div><?php echo htmlspecialchars($user['tbl_user_id']); ?></div>
                <div><?php echo htmlspecialchars($user['first_name']); ?></div>
                <div><?php echo htmlspecialchars($user['last_name']); ?></div>
                <div><?php echo htmlspecialchars($user['contact_number']); ?></div>
                <div><?php echo htmlspecialchars($user['email']); ?></div>
                <div><?php echo htmlspecialchars($user['username']); ?></div>
                <div class="buttons">
                    <button class="update-button" onclick="showUpdateForm(
                        '<?php echo htmlspecialchars($user['tbl_user_id']); ?>',
                        '<?php echo htmlspecialchars(addslashes($user['first_name'])); ?>',
                        '<?php echo htmlspecialchars(addslashes($user['last_name'])); ?>',
                        '<?php echo htmlspecialchars($user['contact_number']); ?>',
                        '<?php echo htmlspecialchars($user['email']); ?>',
                        '<?php echo htmlspecialchars($user['username']); ?>',
                        '<?php echo htmlspecialchars($user['password']); ?>'
                    )"></button>
                     <form action="./endpoint/delete-user.php" method="GET" onsubmit="return confirm('Are you sure you want to delete this user?')">
                    <input type="hidden" name="user" value="<?php echo $user['tbl_user_id']; ?>">
                    <button type="submit" class="delete-button"></button>
                </form>
                      
                </div>
            <?php endforeach; ?>
        </div>
        
    </div>
    


    <!-- registration form -->
    <div class="registration-form" id="registrationForm">  
        <h2 class="text-center">Add User</h2> 
        <button class="exit-button" onclick="exitForm()"></button>
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
             <button type="submit" class="btn btn-dark login-register form-control" name="register">Register </button>
        </form> 
    </div>  

    <!-- update form -->
    <div class="update-form" id="updateForm">  
        <h2 class="text-center">Update User</h2> 
        <button class="exit-button" onclick="exitForm()"></button>
        <p class="text-center">Fill in your personal details.</p>
        <form action="./endpoint/update-user.php" method="POST">
            <input type="hidden" id="updateUserID" name="tbl_user_id">
            <div class="form-group registration row"> 
                <div class="col-6"> 
                    <label for="updateFirstName">First Name: </label> 
                    <input type="text" class="form-control" id="updateFirstName" name="first_name"> 
                </div> 
                <div class="col-6"> 
                    <label for="updateLastName">Last Name: </label> 
                    <input type="text" class="form-control" id="updateLastName" name="last_name"> 
                </div> 
            </div> 
            <div class="form-group registration row"> 
                <div class="col-5"> 
                    <label for="updateContactNumber">Contact Number: </label> 
                    <input type="number" class="form-control" id="updateContactNumber" name="contact_number" maxlength="11"> 
                </div> 
                <div class="col-7"> 
                    <label for="updateEmail">Email: </label> 
                    <input type="text" class="form-control" id="updateEmail" name="email"> 
                </div> 
            </div>
             <div class="form-group registration"> 
                <label for="updateUsername">Username: </label> 
                <input type="text" class="form-control" id="updateUsername" name="username"> 
            </div> 
            <div class="form-group registration"> 
                <label for="updatePassword">Password: </label> 
                <input type="password" class="form-control" id="updatePassword" name="password">
             </div>  
             <button type="submit" class="btn btn-dark login-register form-control" name="register">Update</button>
        </form> 
    </div>


    <script>
        const registrationForm = document.getElementById('registrationForm');
        const updateForm = document.getElementById('updateForm');
        registrationForm.style.display = "none";
        updateForm.style.display = "none";

        function showRegistrationForm() {
            registrationForm.style.display = "";
            updateForm.style.display = "none";
        }

        function exitForm() {
            registrationForm.style.display = "none";
            updateForm.style.display = "none";
        }

        function showUpdateForm(userID, firstName, lastName, contactNumber, email, username, password) {
            updateForm.style.display = "";
            registrationForm.style.display = "none";

            document.getElementById('updateUserID').value = userID;
            document.getElementById('updateFirstName').value = firstName;
            document.getElementById('updateLastName').value = lastName;
            document.getElementById('updateContactNumber').value = contactNumber;
            document.getElementById('updateEmail').value = email;
            document.getElementById('updateUsername').value = username;
            document.getElementById('updatePassword').value = password;
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
