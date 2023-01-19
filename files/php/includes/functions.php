<?php 
// ============ Imports ============

// =================== Functions ===================
function echoHTML_Header() {
    // ======== Start of Function ========
    echo("
    <!DOCTYPE html>
    <html lang='en'>
        <head>
            <title>PixelPlus Server Monitoring Visualization</title>
            <!-- Bootstrap CSS From Files -->
            <link rel='stylesheet' href='./files/css/bootstrap.min.css'

        <body>
    ");
}

function echoHTML_Footer() {
    // ======== Start of Function ========
    echo("
            <!-- Bootstrap JS -->
            <script src='./files/js/bootstrap.min.js'></script>
        </body>
    </html>
    ");
}

function getJSONServerData() {
    // ======= Declaring Variables =======
    $apiEndpoint = "https://servers.pixelplus.nl/api/v1/servers?token=";
    $apiToken = "ZBuwzQqlxQUIWwEbtooWYSPPmdfjnGMU";
    $apiUrl = $apiEndpoint . $apiToken;
    // ======== Start of Function ========
    return json_decode(file_get_contents($apiUrl), true);

}


?>