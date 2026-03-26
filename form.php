<?php
<<<<<<< HEAD

$attempts = isset($_POST['attempts']) ? (int)$_POST['attempts'] + 1 : 0;


$name = $email = $gender = $comment = $website = $phone = $pass = $confirm_pass = $terms = "";
$nameErr = $emailErr = $genderErr = $websiteErr = $phoneErr = $passErr = $termsErr = "";
=======
$nameErr = $emailErr = $genderErr = "";
$name = $email = $website = $comment = $gender = "";
$submitted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true;

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (!empty($_POST["website"])) {
        $website = test_input($_POST["website"]);
        if (!filter_var($website, FILTER_VALIDATE_URL)) {
            $website = "";
        }
    }

    $comment = empty($_POST["comment"]) ? "" : test_input($_POST["comment"]);

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }
}
>>>>>>> f4e5df12bc18368a796fe2740858627d60c2263f

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

<<<<<<< HEAD
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

    Phone Validation
    if (empty($_POST["phone"])) { $phoneErr = "Phone is required"; } 
    else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^[+]?[0-9 \-]{7,15}$/", $phone)) { $phoneErr = "Invalid phone format"; }
    }

    Website Validation
    $website = test_input($_POST["website"]);
    if (!empty($website) && !filter_var($website, FILTER_VALIDATE_URL)) { $websiteErr = "Invalid URL format"; }

    Password Logic
    if (empty($_POST["pass"])) { $passErr = "Password is required"; } 
    else {
        $pass = $_POST["pass"];
        if (strlen($pass) < 8) { $passErr = "Min 8 characters required"; } 
        elseif ($pass !== $_POST["confirm_pass"]) { $passErr = "Passwords do not match"; }
    }

     Gender Validation
    if (empty($_POST["gender"])) { $genderErr = "Gender is required"; } 
    else { $gender = test_input($_POST["gender"]); }

     Terms Checkbox
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
=======
$formValid = $submitted && empty($nameErr) && empty($emailErr) && empty($genderErr);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern PHP Form</title>
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --bg-color: #f9fafb;
            --card-bg: #ffffff;
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --error-red: #ef4444;
            --success-green: #10b981;
            --border-color: #e5e7eb;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            line-height: 1.5;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .form-container {
            background: var(--card-bg);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            margin: 0 0 8px 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: #111827;
        }

        .required-note {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 24px;
        }

        .field-row {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 6px;
            display: block;
        }

        input[type="text"], 
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .radio-group {
            display: flex;
            gap: 15px;
            margin-top: 5px;
        }

        .radio-item {
            display: flex;
            align-items: center;
            font-size: 0.95rem;
        }

        .radio-item input {
            margin-right: 8px;
            accent-color: var(--primary-color);
        }

        .error {
            color: var(--error-red);
            font-size: 0.8rem;
            margin-top: 4px;
        }

        button[type="submit"] {
            width: 100%;
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color: var(--primary-hover);
        }

        /* Message Boxes */
        .success-box, .output-box {
            margin-top: 24px;
            padding: 16px;
            border-radius: 8px;
            font-size: 0.95rem;
        }

        .success-box {
            background-color: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .output-box {
            background-color: #f3f4f6;
            border: 1px solid var(--border-color);
        }

        .output-box h3 {
            margin-top: 0;
            font-size: 1rem;
            color: var(--text-main);
        }

        .output-box p {
            margin: 4px 0;
            color: var(--text-muted);
        }

        .output-box strong {
            color: var(--text-main);
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Get in Touch</h2>
    <p class="required-note">Fields marked with <span style="color:var(--error-red)">*</span> are required.</p>

    <?php if ($formValid): ?>
        <div class="success-box">
            Form submitted successfully!
        </div>
    <?php endif; ?>

    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">

        <div class="field-row">
            <label for="name">Name <span style="color:var(--error-red)">*</span></label>
            <input type="text" id="name" name="name" placeholder="Jane Doe" value="<?= $name ?>">
            <?php if($nameErr): ?><span class="error"><?= $nameErr ?></span><?php endif; ?>
        </div>

        <div class="field-row">
            <label for="email">E-mail <span style="color:var(--error-red)">*</span></label>
            <input type="text" id="email" name="email" placeholder="jane@example.com" value="<?= $email ?>">
            <?php if($emailErr): ?><span class="error"><?= $emailErr ?></span><?php endif; ?>
        </div>

        <div class="field-row">
            <label for="website">Website</label>
            <input type="text" id="website" name="website" placeholder="https://..." value="<?= $website ?>">
        </div>

        <div class="field-row">
            <label for="comment">Comment</label>
            <textarea id="comment" name="comment" placeholder="Tell us more..."><?= $comment ?></textarea>
        </div>

        <div class="field-row">
            <label>Gender <span style="color:var(--error-red)">*</span></label>
            <div class="radio-group">
                <label class="radio-item"><input type="radio" name="gender" value="Female" <?= ($gender == "Female") ? "checked" : "" ?>> Female</label>
                <label class="radio-item"><input type="radio" name="gender" value="Male" <?= ($gender == "Male") ? "checked" : "" ?>> Male</label>
                <label class="radio-item"><input type="radio" name="gender" value="Other" <?= ($gender == "Other") ? "checked" : "" ?>> Other</label>
            </div>
            <?php if($genderErr): ?><span class="error"><?= $genderErr ?></span><?php endif; ?>
        </div>

        <button type="submit">Send Message</button>
    </form>

    <div class="output-box">
        <?php if ($submitted && $formValid): ?>
            <h3>Your Input:</h3>
            <p><strong>Name:</strong> <?= $name ?></p>
            <p><strong>E-mail:</strong> <?= $email ?></p>
            <?php if (!empty($website)): ?><p><strong>Website:</strong> <?= $website ?></p><?php endif; ?>
            <p><strong>Gender:</strong> <?= $gender ?></p>
        <?php elseif ($submitted && !$formValid): ?>
            <p style="color:var(--error-red); margin:0;">Please fix the errors and try again.</p>
        <?php else: ?>
            <p style="margin:0; font-style: italic;">Results will appear here after submission.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
>>>>>>> f4e5df12bc18368a796fe2740858627d60c2263f
