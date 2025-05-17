<?php
session_start();

$admin_email = "admin@gmail.com";
$admin_password = "0";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{ if ($_POST["role"] == "admin") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        if ($email === $admin_email && $password === $admin_password) {
            $_SESSION['admin'] = true;
            header("Location:index.php");
            exit();
        } else {
            $error = "Invalid admin credentials.";
        }
    } elseif ($_POST["role"] == "user") {
        $_SESSION['admin'] = false;
        header("Location:index.php");
        exit();
    }
}
?>

<head>
    <title>Choose Role - Pet Adoption</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
    font-family: 'Poppins', sans-serif;
    background: url('loginbk.png') no-repeat center center fixed;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

        .box {
            background-color: white;
            padding: 40px 30px;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(91, 33, 182, 0.1);
            text-align: center;
            width: 320px;
            border: 1px solidrgb(0, 0, 0);
        }

        .selectrole{
            font-size: larger;
            font-family: sans-serif;
            font-variant: small-caps;
            
        }
        .admin{
        font-size: 15px;
        font-family: sans-serif;
        border: 1px solid white;
        border-radius: 24px;
        background-color:rgba(167, 139, 250, 0.46);
        padding: 10px;
        }

        h2 {
            color: #5b21b6;
            margin-bottom: 24px;
            font-weight: 600;
        }

        label {
            display: block;
            margin: 10px 0;
            font-size: 15px;
            color: #4b0082;
        }

        input[type="radio"] {
            margin-right: 8px;
        }

        .admin-fields {
            display: none;
            flex-direction: column;
            align-items: center;
            margin-top: 15px;
        }

        input[type="email"],
        input[type="password"],
        button {
            width: auto;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd6fe;
            border-radius: 12px;
            font-size: 14px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
        }

        input:focus, button:focus {
            outline: none;
            border-color: #a78bfa;
            box-shadow: 0 0 0 2px rgba(167, 139, 250, 0.3);
        }

        button {
            background-color:rgb(127, 68, 229);
            color: white;
            font-weight: 600;
            transition: background 0.3s ease;
            cursor: pointer;
        }

        button:hover {
            background-color: #6d28d9;
        }


        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
    <script>
        function toggleFields() {
            const role = document.querySelector('input[name="role"]:checked').value;
            const adminFields = document.getElementById("adminFields");
            const emailInput = document.querySelector('input[name="email"]');
            const passwordInput = document.querySelector('input[name="password"]');

            if (role === "admin") {
                adminFields.style.display = "flex";
                emailInput.required = true;
                passwordInput.required = true;
            } else {
                adminFields.style.display = "none";
                emailInput.required = false;
                passwordInput.required = false;
            }
        }
    </script>
</head>
<body>
    <form method="POST" class="box">
        <div class="selectrole"><h2>Select Role</h2></div>
<br>
<div class="admin">
        <label><input type="radio" name="role" value="admin" onclick="toggleFields()" required > Admin</label><br>
        <label><input type="radio" name="role" value="user" onclick="toggleFields()" > User</label>
        <br>
        <button type="submit">Continue</button>
        </div>
        <div id="adminFields" class="admin-fields">
            <input type="email" name="email" placeholder="Admin Email" required>
            <input type="password" name="password" placeholder="Root Password" required>
            </div>
        

        

        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
    </form>
</body>
</html>