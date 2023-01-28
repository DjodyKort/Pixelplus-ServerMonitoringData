<?php
session_start();
// Checking Access
// ============= Imports =============
include_once("../includes/security_inc.php");
checkAuth($_SESSION['AccessGranted']);
include_once("../includes/functions.php");
include_once("../includes/database_inc.php");


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

foreach ($jsonData as $server) {
    // Checking if services exist
    if (!empty($server['services'])) {
        $serverServices = $server['services'];
    }
    else {
        $serverServices = array();
    }
    echo ("
        <div class='card mx-auto' style='width:600px;'>
            <div class='card-header'>
                <h3 class='card-title text-center'>".$server['display_name']."</h3>
                <div class='text-margin-card'>
                    <img width='25px' src='../../img/Online.png'/> <span><b>Last - </b>".unixToHuman($server['last_uptime'])."</span>
                    <br/>
                    <span style='margin-left: 40px'><b>IP - </b>".$server['ip']."</span>
                </div>
            </div>
            <div class='card-body'>
                <!-- Colapsable button -->
                <h4 class='mainpage-h4'>Drives</h4>
                <a class='btn btn-primary center' data-bs-toggle='collapse' href='#button".spacesToUnderscores($server['display_name'])."Drives' role='button' aria-expanded='false' aria-controls='button".spacesToUnderscores($server['display_name'])."Drives'>
                    <img width='50px' src='../../img/Dropdown.png'/>
                </a>

                <!-- Collapsable Content (Drives) -->
                <div class='collapse' id='button".spacesToUnderscores($server['display_name'])."Drives'>
                    <div class='accordion accordion-flush' id='accordionFlushExample'>");
                        echoServerDriveContent($server['drives'], spacesToUnderscores($server['display_name'])); echo("
                    </div>
                </div>
                
                <hr/>
                
                <!-- Colapsable button -->
                <h4 class='mainpage-h4'>Services</h4>
                <a class='btn btn-primary center' data-bs-toggle='collapse' href='#button".spacesToUnderscores($server['display_name'])."Services' role='button' aria-expanded='false' aria-controls='button".spacesToUnderscores($server['display_name'])."Services'>
                    <img width='50px' src='../../img/Dropdown.png'/>
                </a>
                
                <!-- Collapsable Content (Services) -->
                <div class='collapse' id='button".spacesToUnderscores($server['display_name'])."Services'>");
                    echoServerServiceContent($serverServices); echo("
                </div>
                
                

            </div>
        </div>
        <br/><br/><br/><br/>
    ");
}
echoHTML_Footer("Mainpage - Server Monitor");