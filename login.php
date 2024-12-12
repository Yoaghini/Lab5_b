<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>

    <style>
        label, input 
        {
            display: block;
            margin: 10px 0;
        }

    </style>

</head>

<body>

    <h2>Login</h2>

    <?php

    session_start();

    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Lab_5b"; 

   
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $matric = $_POST['matric'];
        $password = $_POST['password'];

        
        $query = "SELECT * FROM users WHERE matric = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $matric);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) 
        {
            $user = $result->fetch_assoc();

            
            if (password_verify($password, $user['password'])) 
            {
                
                $_SESSION['user_id'] = $user['matric'];
                $_SESSION['username'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                header('Location: display.php'); 

                exit();

            } else 
            {
                
                $error_message = "Invalid username or password, try <a href='login.php'>login</a> again.";
            }
        } else 
        {
            
            $error_message = "Invalid username or password, try <a href='login.php'>login</a> again.";
        }
    }
    ?>

    <form action="login.php" method="post">
        <label for="matric">Matric:</label>
        <input type="text" name="matric" id="matric" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" value="Login">
    </form>

    <?php if (!empty($error_message)): ?>
        <p style="color: black;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <p><a href="register.php">Register</a> here if you have not</p>

</body>

</html>








