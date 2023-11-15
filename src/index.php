<?php

// Function to check if the password is common
function isCommonPassword($password)
{
    // Read the list of common passwords from the text file
    $commonPasswords = file("10-million-password-list-top-1000.txt", FILE_IGNORE_NEW_LINES);

    // Convert the user input to lowercase for case-insensitive comparison
    $passwordLower = strtolower($password);

    // Check if the password is in the common passwords list
    return in_array($passwordLower, $commonPasswords);
}

// Function to validate input
function validateInput($input)
{
    // Check for common passwords
    if (isCommonPassword($input)) {
        return "Invalid Input: Common Password";
    }

    // ELSE: PREVENT SQL INJECTION ATTACKS
    if (!preg_match('/^[a-zA-Z0-9]+$/', $input)) {
        return "Invalid Input: Invalid Characters";
    }

    // ELSE: RETURN INPUT
    return $input;
}

if (isset($_POST['submit'])) {
    // Use trim to remove leading and trailing whitespaces
    $userPassword = trim($_POST['password']);

    // Validate the input
    $validatedPassword = validateInput($userPassword);

    // If the input is invalid, CLEAR the password and stay on the home page
    if (strpos($validatedPassword, "Invalid Input") !== false) {
        $userPassword = "";
    }
    // If the input is valid, redirect to welcome.php
    else {
        session_start();
        $_SESSION['user_password'] = $validatedPassword;
        header("Location: welcome.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
</head>

<body>

    <div>
        <h1>PHP Website</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <div>
                <label>Password</label>
                <input type="password" name="password" required placeholder="Enter Your Password">
            </div>
            <div>
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>