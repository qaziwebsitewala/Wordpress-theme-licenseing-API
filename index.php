<?php
// Include necessary files
require_once 'api-handler.php';
require_once 'license-validation.php';

// Assuming you have a form where the user submits the license key
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming the API call is made to the license validation endpoint
    $licenseKey = $_POST['license_key'];
    $apiUrl = 'http://localhost/blockFY/LicenseKey-Api/license-validation.php'; // Replace with your actual API URL

    // Make an API request to check if the license key is valid
    $response = file_get_contents($apiUrl, false, stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query(['key' => $licenseKey])
        ]
    ]));

    // Decode API response
    $result = json_decode($response, true);

    // Check if the license key is valid or not
    if ($result && isset($result['success']) && $result['success'] === true) {
        // Show success message if the key is valid
        echo '<p>License key is valid! You can proceed.</p>';
    } else {
        // Show error message if the key is invalid
        echo '<p>Invalid license key. Please enter a valid key.</p>';
    }
}
?>
<!-- Your HTML form for entering the license key -->
<form method="post" action="">
    <label for="license_key">Enter your license key:</label><br>
    <input type="text" id="license_key" name="license_key" required><br>
    <input type="submit" name="validate_license" value="Validate License">
</form>
