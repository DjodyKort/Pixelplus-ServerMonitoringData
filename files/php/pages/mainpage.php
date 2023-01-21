<?php
session_start();
// Checking Access
if(!$_SESSION['AccessGranted']){
    header('location:../../../index.php');
}
// ============= Imports =============
include_once("../includes/functions.php");
include_once("../includes/database_inc.php");
include_once("../includes/security_inc.php");

// ==================== Declaring Variables ====================
$jsonData = getJSONServerData();
// ===================== Start of Code =====================

// ==== HTML Echo ====
// Creating new user form
echoHTML_Header("Mainpage - Server Monitor");
echoNavbar("Mainpage - Server Monitor");
echo("
    <h1>PixelPlus Server Monitor System</h1>
    
    <div>
    
    </div>
");
echoHTML_Footer("Mainpage - Server Monitor");