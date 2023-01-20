<?php
// ======================== Functions ========================
// Function to connect to the database
function connectToDB(){
    $Hostname   = "localhost";      // Database servername
    $DBname     = "deb142504_pixelplus";           // Database name
    $Username   = "deb142504_pixelplus";           // Database Email
    $Password   = "100%procentVeiligWachtwoord";   // Database user password
    $conn = new PDO("mysql:host=$Hostname; dbname=$DBname", $Username, $Password); // Create the actual connection
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return($conn);
}

// Function to execute a query and return the fetched data as array
function PdoSqlReturnArray($sPdoQuery, $p_arrValues=NULL){
    $DBconnect = connectToDB();                                    // Connect to the MySQL database
    $statement = $DBconnect->prepare($sPdoQuery);                 // Make the query with the parameter(s)
    if ($p_arrValues == NULL) {$aResult = $statement->execute();}// Execute the query and put the results in the $aResult
    else {$aResult = $statement->execute($p_arrValues);}        // Execute the query and put the results in the $aResult
    $aResult = $statement->execute($p_arrValues);              // Execute the query and put the results in the $aResult
    $arr_rows = $statement->fetchAll(PDO::FETCH_ASSOC); // Put all fetched data into a nested array
    $DBconnect=NULL;                                         // Close the connection
    return($arr_rows);                                      // Return the array data back to the calling method
}

// Function to excecute SQL query and return True
function PdoSqlReturnTrue($sPdoQuery, $p_arrValues){
    try {
        $DBconnect = connectToDB();                    // Connect to the MySQL database
        $statement = $DBconnect->prepare($sPdoQuery); // Make the query with the parameter
        $result = $statement->execute($p_arrValues); // Put the results in the $result
        $DBconnect=NULL;                            // Close the connection
        return(TRUE);                              // Return to the calling method
    }
    catch(Exception $e) {
        echo "Error: " . $e->getMessage();
        return(FALSE);
    }
}
