<?php
session_start();
// Checking Access

// ============= Imports =============
include_once("./files/php/includes/functions.php");
include_once("./files/php/includes/database_inc.php");
include_once("./files/php/includes/security_inc.php");

// ==================== Declaring Variables ====================
// Setting session AccessGranted to false
$_SESSION['AccessGranted'] = False;
// ==== POST ====
if (!empty($_POST)) {
    $formEmail = cleanPost("formEmail");
    $formPassword = cleanPost("formPassword");

    // SQL Querys
    $sqlQuery = "SELECT * FROM `users_tbl`;";
}

// ===================== Start of Code =====================
if (!empty($_POST)) {
    $accounts = PdoSqlReturnArray($sqlQuery);
    foreach ($accounts as $account) {
        $decEmail = strDecrypt($account["encEmail"], $account["encNonce"], $account["encKey"]);

        if ($decEmail === $formEmail) {
            if (password_verify($formPassword, $account["encPassword"])) {
                $_SESSION['AccessGranted'] = True;
                header("Location: ./files/php/pages/mainpage.php");
            }
            else {
                echo("Credentials are incorrect");
            }
        }
        else {
            echo("Credentials are incorrect");
        }
    }
}
// ==== HTML Echo ====
// CSRF Token
createCSRF();
// Login Screen
echoHTML_Header("Mainpage");
echo("
    <h1 class='text-center'>PixelPlus Server Monitoring Login</h1>
    
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
            <button type='submit' class='btn btn-primary'>Submit</button>
        </form>
    </div>
");
echoHTML_Footer("Mainpage");
?>