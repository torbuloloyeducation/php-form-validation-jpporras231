<?php
// Exercise 5: Initialize submission counter
$attempts = isset($_POST['attempts']) ? (int)$_POST['attempts'] + 1 : 0;

// Initialize variables and errors
$name = $email = $gender = $comment = $website = $phone = $pass = $confirm_pass = $terms = "";
$nameErr = $emailErr = $genderErr = $websiteErr = $phoneErr = $passErr = $termsErr = "";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Name Validation
    if (empty($_POST["name"])) { $nameErr = "Name is required"; } 
    else { $name = test_input($_POST["name"]); }

    // Email Validation
    if (empty($_POST["email"])) { $emailErr = "Email is required"; } 
    else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $emailErr = "Invalid email format"; }
    }

    // Exercise 1: Phone Validation
    if (empty($_POST["phone"])) { $phoneErr = "Phone is required"; } 
    else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^[+]?[0-9 \-]{7,15}$/", $phone)) { $phoneErr = "Invalid phone format"; }
    }

    // Exercise 2: Website Validation
    $website = test_input($_POST["website"]);
    if (!empty($website) && !filter_var($website, FILTER_VALIDATE_URL)) { $websiteErr = "Invalid URL format"; }

    // Exercise 3: Password Logic
    if (empty($_POST["pass"])) { $passErr = "Password is required"; } 
    else {
        $pass = $_POST["pass"];
        if (strlen($pass) < 8) { $passErr = "Min 8 characters required"; } 
        elseif ($pass !== $_POST["confirm_pass"]) { $passErr = "Passwords do not match"; }
    }

    // Gender Validation
    if (empty($_POST["gender"])) { $genderErr = "Gender is required"; } 
    else { $gender = test_input($_POST["gender"]); }

    // Exercise 4: Terms Checkbox
    if (!isset($_POST['terms'])) { $termsErr = "Terms must be accepted"; } 
    else { $terms = "checked"; }

    $comment = test_input($_POST["comment"]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Form Validation</title>
    <style>
    body { 
        /* The image uses a clean, standard Arial font stack */
        font-family: Arial, Helvetica, sans-serif; 
        background-color: #ffffff; 
        color: #000000; 
        padding: 40px; 
    }
    
    .container { 
        max-width: 400px; 
        margin: 0 auto; 
        padding: 5px; 
    }

    label { 
        display: block; 
        /* Labels in the image are slightly larger and standard weight */
        font-size: 18px; 
        font-weight: 500;
        margin-top: 22px; 
        margin-bottom: 8px;
    }

    input, 
    input[type=password], 
    textarea {
        width: 100%; 
        padding: 10px; 
        font-size: 16px; 
        border: 1px solid #767676; 
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif; /* Ensure input text matches */
    }

    .gender-options {
        margin-top: 5px;
        font-size: 18px;
    }

    .error { 
        color: #d93025; 
        font-size: 14px; 
        margin-top: 5px;
        display: block;
    }

    .attempts { 
        font-size: 18px; 
        margin-bottom: 20px; 
    }
</style>

</head>
<body>

<div class="container">
    <h2>PHP Form Validation</h2>
    <p class="info-text">Fields marked <span style = "color:red;" >*</span> are required.</p>
    <p class="info-text">Submission attempt: <?php echo $attempts; ?></p>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <!-- Exercise 5: Hidden Counter -->
        <input type="hidden" name="attempts" value="<?php echo $attempts; ?>">

        <label>Name <span style = "color:red;">*</span></label>
        <input type="text" name="name" value="<?php echo $name;?>">
        <span class="error"><?php echo $nameErr;?></span>

        <label>Email <span style = "color:red;">*</span></label>
        <input type="text" name="email" value="<?php echo $email;?>">
        <span class="error"><?php echo $emailErr;?></span>

        <label>Phone <span style = "color:red;">*</span></label>
        <input type="text" name="phone" value="<?php echo $phone;?>">
        <span class="error"><?php echo $phoneErr;?></span>

        <label>Website</label>
        <input type="text" name="website" value="<?php echo $website;?>">
        <span class="error"><?php echo $websiteErr;?></span>

        <label>Password <span style = "color:red;">*</span></label>
        <input type="password" name="pass">
        <span class="error"><?php echo $passErr;?></span>

        <label>Confirm Password <span style = "color:red;">*</span></span></label>
        <input type="password" name="confirm_pass" placeholder="Re-enter your password">
        <span class="error"><?php if ($passErr == "Passwords do not match") echo $passErr; ?></span>

        <label>Gender <span style = "color:red;">*</span></label>
        <input type="radio" name="gender" <?php if ($gender=="female") echo "checked";?> value="female"> Female
        <input type="radio" name="gender" <?php if ($gender=="male") echo "checked";?> value="male"> Male
        <span class="error"><?php echo $genderErr;?></span>

        <label>Comments</label>
        <textarea name="comment" rows="3"><?php echo $comment;?></textarea>

        <div style="margin-top:10px;">
            <input type="checkbox" name="terms" <?php echo $terms; ?>> I agree to the terms
            <span class="error"><?php echo $termsErr; ?></span>
        </div>

        <input type="submit" name="submit" value="Submit Form">
    </form>

    <p class="attempts">Submission attempt: <?php echo $attempts; ?></p>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && 
        !$nameErr && !$emailErr && !$phoneErr && !$websiteErr && !$passErr && !$genderErr && !$termsErr) {
        
        echo "<div class='result-box'>";
        echo "<strong>SUCCESSFUL SUBMISSION</strong><br>";
        echo "Name: $name <br>";
        echo "Email: $email <br>";
        echo "Phone: $phone <br>";
        echo "Gender: $gender";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>
