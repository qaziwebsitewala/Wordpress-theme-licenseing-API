<?php
// Function to call the License API and validate the license key
function validateLicenseKey($licenseKey) {
    // Call the License API
       $apiEndpoint = "http://localhost/blockFY/LicenseKey-Api/license-validation.php";

    // Make the API request (you can use cURL,and file_get_content
    

     $response = file_get_contents($apiEndpoint);

    // Decode the JSON response
    $responseData = json_decode($response, true);

    // Extract information from the API response
    if ($responseData && isset($responseData['isValid'])) {
        return $responseData['isValid'];
    }

    // Default to false if validation fails or response is invalid
    return false;
}
?>
