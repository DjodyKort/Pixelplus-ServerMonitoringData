<?php
session_start();
// ============= Imports =============
include_once("../includes/security_inc.php");
checkAuth($_SESSION['AccessGranted']);
include_once("../includes/functions.php");
include_once("../includes/database_inc.php");

// ==================== Declaring Variables ====================
// ==== POST ====
if (!empty($_POST)) {
    $formEmail = cleanPost("formEmail");
    $formPassword = cleanPost("formPassword");
    $formConfirmPassword = cleanPost("formConfirmPassword");
    if ($formPassword === $formConfirmPassword) {
        // Enrypting the email
        $encEmailArray = strEncrypt($formEmail);
        $encEmail = $encEmailArray[0];
        $encNonce = $encEmailArray[1];
        $encKey = $encEmailArray[2];
        // Enrypting the password
        $encPassword = password_hash($formPassword, PASSWORD_DEFAULT);

        // SQL
        $sqlQuery = "INSERT INTO `users_tbl` (`encEmail`, `encNonce`, `encKey`, `encPassword`) VALUES (?, ?, ?, ?);";
        $arrSqlValues = array($encEmail, $encNonce, $encKey, $encPassword);
    }
    else {
        // Passwords do not match
        echo("Passwords do not match... Please try again");
    }
}


// ===================== Start of Code =====================
// ==== POST ====
if (!empty($_POST)) {
        if ($formPassword === $formConfirmPassword) {
            // Creating the user
            $booReturn = PdoSqlReturnTrue($sqlQuery, $arrSqlValues);
            if ($booReturn) {
                echo("User created");

            }
            else {
                echo("User not created and something went wrong");
                echo($booReturn);
            }
        }
}

// ==== HTML Echo ====
// CSRF Token
createCSRF();
// Creating new user form
echoHTML_Header("User Creation");
echoNavbar();
echo("
    <h1 class='text-center'>PixelPlus Server Monitoring User Creation</h1>
    <div class='container'>
        <form method='POST'>
            <div class='form-group'>
                <label for='idFormEmail'>Email: </label>
                <input type='text' class='form-control' name='formEmail' id='idFormEmail' placeholder='Enter Email'>
            </div>
            <div class='form-group'>
                <label for='idFormPassword'>Password: </label>
                <input type='password' class='form-control' name='formPassword' id='idFormPassword' placeholder='Enter Password'>
            </div>
            <div class='form-group'>
                <label for='idFormConfirmPassword'>Confirm Password: </label>
                <input type='password' class='form-control' name='formConfirmPassword' id='idFormConfirmPassword' placeholder='Confirm Password'>
            </div>
            <button type='submit' class='btn btn-primary'>Submit</button>
        </form>
    </div>
");
echoHTML_Footer("User Creation");