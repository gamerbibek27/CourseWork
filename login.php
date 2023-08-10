<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    // Sanitize the entered email before using it in the query
    $email = $mysqli->real_escape_string($_POST["email"]);
    
    // Construct the SQL query
    $sql = "SELECT * FROM user WHERE email = '$email'";
    
    // Execute the query and handle errors
    $result = $mysqli->query($sql);
    if (!$result) {
        die("Query error: " . $mysqli->error);
    }
    
    // Fetch the user data
    $user = $result->fetch_assoc();
    
    if ($user) {
        // Verify the entered password against the stored hash
        if (password_verify($_POST["password"], $user["password_hash"])) {
            session_start();
            session_regenerate_id(); // Prevents session fixation attack
            $_SESSION["user_id"] = $user["id"];
            if ($user['role'] ==="admin"){
              header("Location: admin.php");
            }else{
            header("Location: index.php");
            };
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    
    <h1>Login</h1>
    
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    
    <form method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        
        <button>Log in</button>
    </form>
    
</body>
</html>
