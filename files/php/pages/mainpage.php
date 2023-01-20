<?php
session_start();
// Checking Access
if(!$_SESSION['AccessGranted']){
    header('location:../../index.php');
}
// ============= Imports =============
include_once("../includes/functions.php");
include_once("../includes/database_inc.php");
include_once("../includes/security_inc.php");

// ==================== Declaring Variables ====================
// ==== POST ====


// ===================== Start of Code =====================
// ==== POST ====


// ==== HTML Echo ====
// Creating new user form
echoHTML_Header();
echoNavbar();
echo("
    
");
echoHTML_Footer();