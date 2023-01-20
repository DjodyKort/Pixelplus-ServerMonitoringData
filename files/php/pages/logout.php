<?php
session_start();
// ============= Imports =============
include_once("../includes/functions.php");
include_once("../includes/database_inc.php");
include_once("../includes/security_inc.php");

// ==================== Declaring Variables ====================

// ===================== Start of Code =====================
unset($_SESSION['AccessGranted']);

echoHTML_Header("Logout");
echo("
<h1>U bent afgemeld</h1>
");
echoHTML_Footer("Logout");

// Navigate to the index page
header('location:../../../index.php');