<?php 
// ============ Imports ============

// =================== Functions ===================
function createCSRF(): void{
    $_SESSION["csrfToken"] = base64_encode(random_bytes(32));
}

function getJSONServerData() {
    // ======= Declaring Variables =======
    $apiEndpoint = "https://servers.pixelplus.nl/api/v1/servers?token=";
    $apiToken = "ZBuwzQqlxQUIWwEbtooWYSPPmdfjnGMU";
    $apiUrl = $apiEndpoint . $apiToken;
    // ======== Start of Function ========
    $jsonData = json_decode(file_get_contents($apiUrl), true);
    if ($jsonData["success"]) {
        return $jsonData["data"];
    }
    else {return false;}
}

function unixToHuman($unixTime) {
    // ======= Declaring Variables =======
    $date = date("d-m-Y", $unixTime);
    $time = date("H:i:s", $unixTime);

    // ======== Start of Function =======
    if ($date == date("d-m-Y")) {
        return "Today at " . $time;
    }
    else if ($date == date("d-m-Y", strtotime("-1 day"))) {
        return "Yesterday at " . $time;
    }
    else {
        return $date . " at " . $time;
    }
}


function spacesToUnderscores($str): string {
    // ======== Declaring Variables ========
    // ======== Start of Function ========
    return str_replace(" ", "_", $str);
}


function decimalToPercentage($strDecimal) {
    // ======= Declaring Variables =======

    // ======== Start of Function =======
    return $strDecimal * 100 . "%";
}

function kiloBytestoGigabytes($strKiloBytes) {
    // ======= Declaring Variables =======

    // ======== Start of Function =======
    return round($strKiloBytes / 1000000, 2) . " GB";
}


// ======================== HTML Functions ========================
function echoHTML_Header(string $page=""): void {
    // ======== Declaring Variables ========
    $strPageTitle = "PixelPlus - " . $page;
    if ($page != "Mainpage") {
        $bootstrapHref = "../../css/bootstrap.min.css";
        $styleSheet = "../../css/style.css";
    }
    else {
        $bootstrapHref = "./files/css/bootstrap.min.css";
        $styleSheet = "./files/css/style.css";
    }
    // ======== Start of Function ========
    echo("
    <!DOCTYPE html>
    <html lang='en'>
        <head>
            <title>PixelPlus Server Monitoring Visualization</title>
            <!-- Jquery -->
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js'></script>
            <!-- Bootstrap CSS From Files -->
            <link rel='stylesheet' href='".$bootstrapHref."'>
            <!-- Custom CSS -->
            <link rel='stylesheet' href='".$styleSheet."'>
        </head>
        
        <body>
    ");
}


function echoNavbar(string $page=""): void {
    // ======== Declaring Variables ========
    // ======== Start of Function ========
    echo("
        <navbar>
            <ul class='nav nav-tabs'>
                <li class='nav-item'>
                    <a class='nav-link' href='./mainpage.php'>Servers</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='./create_user.php'>Create User</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='./logout.php'>Logout</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='https://github.com/DjodyKort/Pixelplus-ServerMonitoringData/'>Github of Project</a>
                </li>
            </ul>
    </navbar>
    ");
}


function echoHTML_Footer(string $page=""): void {
    // ======== Declaring Variables ========
    if ($page != "Mainpage") {
        $bootstrapHref = "../../js/bootstrap.bundle.min.js";
    }
    else {
        $bootstrapHref = "./files/js/bootstrap.bundle.min.js";
    }
    // ======== Start of Function ========
    echo("
            <footer>
                <!-- Bootstrap JS -->
                <script src='".$bootstrapHref."'></script>
            </footer>
        </body>
    </html>
    ");
}


function echoServerDriveHistory($serverDriveHistoryData, $serverNameAndID)
{
    // Declaring Variables
    echo("<div class='accordion accordion-flush' id='accordionFlushServerHistory".$serverNameAndID."'>");
    foreach ($serverDriveHistoryData as $history) {
        // Declaring Variables
        $targetID = $serverNameAndID.$history["date_added"].$history["date_updated"];
        echo("
        <!-- Accordion item 1 -->
        <div class='accordion-item'>
            <!-- Accordion header 1 -->
            <h2 class='accordion-header' id='flush-headingOne".$targetID."'>
                <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapseOne".$targetID."' aria-expanded='false' aria-controls='flush-collapseOne".$targetID."'>
                    <b>".unixToHuman($history["date_updated"]-3600)."</b>
                </button>
            </h2>
            <!-- Accordion body 1 -->
            <div id='flush-collapseOne".$targetID."' class='accordion-collapse collapse' aria-labelledby='flush-headingOne".$targetID."' data-bs-parent='#accordionFlushServerHistory".$serverNameAndID."'>
                <div class='accordion-body'>
                    <p><b>Total Disk Space:</b> ".kiloBytestoGigabytes($history["total_disk_space"])."</p>
                    <p><b>Free Disk Space:</b> ".kiloBytestoGigabytes($history['free_disk_space'])."</p>
                </div>
            </div>
        </div>
        ");
    }
    echo("</div>");
}


function echoServerDriveContent($serverDriveData, $serverName)
{
    // ====== Declaring Variables ======
    foreach ($serverDriveData as $drive) {
        // Declaring Variables
        $targetID = $serverName.$drive['directory'];
        // Echoing HTML
        echo("
        <div>
            <!-- Collapsable Button -->
            <button class='btn btn-primary' type='button' data-bs-toggle='collapse' data-bs-target='#drive".$targetID."' aria-expanded='false' aria-controls='drive".$targetID."'>
                Directory - ".$drive['directory']."
            </button>
            <!-- Collapsable Content -->
            <div class='collapse' id='drive".$targetID."'>
                <div class='card card-body'>
                    <p><b>Maximal Usage:</b> ".decimalToPercentage($drive['disk_max_usage'])."</p><br/>
                    <p><b>Date added:</b> ".unixToHuman($drive['date_added']-3600)."</p>
                    <p><b>Date updated:</b> ".unixToHuman($drive['date_updated']-3600)."</p><br/>
                    <br/>
                    <h4 class='text-center'>History:</h4>");
                    echoServerDriveHistory($drive['history'], $targetID); echo("
                </div>
            </div>
        </div>
        <br/>   
       ");
    }
}


function echoServerServiceContent($serverServiceData): void
{
    if (empty($serverServiceData)) {
        echo("
        <div>
            <p>There are no services running on this server.</p>
        </div>
       ");
    }
    else {
        foreach ($serverServiceData as $service) {
            echo("
            <div>
                <hr/>
                <p><b>Service: </b>".$service['display_name']."</p>
                <p><b>Version: </b> ".$service['version']."</p>
                <br/>
                <p><b>Date Updated: </b> ".unixToHuman($service['date_updated'])."</p>
                <p><b>Date Added: </b>".unixToHuman($service['date_added'])."</p>
                <br/>
            </div>
           ");
        }
    }
}
?>