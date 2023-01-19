<?php 
// ============= Imports =============
include_once("./files/php/includes/functions.php");

// ==================== Declaring Variables ====================
$jsonServerData = getJSONServerData();

// ==== POST ====
if (!empty($_POST)) {
    $strUsername = $_POST["formUsername"];
    $strPassword = $_POST["formPassword"];
}

// ===================== Start of Code =====================
// ==== POST ====
if (!empty($_POST)) {
    if ($strUsername == "admin" && $strPassword == "admin") {
        echo("Login Successful");
    } else {
        echo("Login Failed");
    }
}
// CSRF Token
$_SESSION["csrfToken"] = base64_encode(random_bytes(32));

// ==== HTML Echo ====
// Login Screen
echoHTML_Header();
echo("
    <h1 class='text-center'>PixelPlus Server Monitoring Login</h1>
    
    <div class='container'>
        <form method='POST'>
            <div class='form-group'>
                <label for='username'>Username: </label>
                <input type='text' class='form-control' name='formUsername' id='idFormUsername' placeholder='Enter Username'>
            </div>
            <div class='form-group'>
                <label for='password'>Password: </label>
                <input type='password' class='form-control' name='formPassword' id='idFormPassword' placeholder='Enter Password'>
            </div>
            <input type='hidden' name='formCSRFToken' id='idFormCSRFToken' content='".$_SESSION['csrfToken']."'>
            <button type='submit' class='btn btn-primary'>Submit</button>
        </form>
    </div>
");
echoHTML_Footer();

?>