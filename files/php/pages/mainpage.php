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
    <h1 class='text-center'>PixelPlus Server Monitoring System</h1>
");
echo("<div class='container'>");
foreach ($jsonData as $server) {
    echo ("
        <div class='card'>
            <div class='card-header'>
                <h3 class='card-title'>".$server['display_name']."</h3>
            </div>
            <div class='card-body'>
                <p class='card-text'>IP: ".$server['ip']."</p>
                <p class='card-text'>Last Uptime: ".$server['last_uptime']."</p>
        </div>
    ");
}
echo("</div>");
echoHTML_Footer("Mainpage - Server Monitor");