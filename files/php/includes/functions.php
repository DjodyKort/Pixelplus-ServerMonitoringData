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
    return json_decode(file_get_contents($apiUrl), true);

}

// HTML Functions
function echoHTML_Header(string $page=""): void {
    // ======== Declaring Variables ========
    $strPageTitle = "PixelPlus - " . $page;
    if ($page != "Mainpage") {
        $bootstrapHref = "../../css/bootstrap.min.css";
    }
    else {
        $bootstrapHref = "./files/css/bootstrap.min.css";
    }
    // ======== Start of Function ========
    echo("
    <!DOCTYPE html>
    <html lang='en'>
        <head>
            <title>PixelPlus Server Monitoring Visualization</title>
            <!-- Bootstrap CSS From Files -->
            <link rel='stylesheet' href='".$bootstrapHref."'
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
            <!-- Bootstrap JS -->
            <script src='".$bootstrapHref."'></script>
        </body>
    </html>
    ");
}
?>