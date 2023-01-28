<?php
session_start();
// ============= Imports =============
include_once("../includes/security_inc.php");
checkAuth($_SESSION['AccessGranted']);
include_once("../includes/functions.php");
include_once("../includes/database_inc.php");

// ==================== Declaring Variables ====================
$sql = "SHOW GRANTS FOR CURRENT_USER;";
try {
    $result = PdoSqlReturnArray($sql);
}
catch (PDOException $e) {
    $result = $e->getMessage();
}

// ===================== Start of Code =====================
echoHTML_Header("Experimentation thingy");
echoNavbar();
echo($result);
echoHTML_Footer("Experimentation thingy");
