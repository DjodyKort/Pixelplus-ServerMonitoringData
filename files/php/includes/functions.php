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


function decimalToPercentage($strDecimal) {
    // ======= Declaring Variables =======

    // ======== Start of Function =======
    return $strDecimal * 100 . "%";
}


// HTML Functions
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
                    <a class='nav-link' href='./logout.php'>Logout</a>
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
            <!-- Jquery -->
            
            <!-- Bootstrap JS -->
            <script src='".$bootstrapHref."'></script>
        </body>
    </html>
    ");
}

// Collapse Content
// Drive Content
function serverDriveContent($serverDriveData): void
{
    foreach ($serverDriveData as $drive) {
        echo("
       <div>
            <p>Disk Usage: ".decimalToPercentage($drive['disk_max_usage'])."</p>
            <p> </p>
        </div>
       ");
    }
}


function serverServiceContent($serverServiceData): void
{
    foreach ($serverServiceData as $service) {
        echo("
       <div>
            <p>Service: ".$service['name']."</p>
        </div>
       ");
    }
}

// Services Content
?>