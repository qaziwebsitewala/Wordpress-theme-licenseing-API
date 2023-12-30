<?php

// Simulated database of valid license keys
$validLicenseKeys = ['kpxwxrsoly', 'kpxwxrsoly12', 'kpxwxrsoly0']; 

// Function to validate a license key
function validateLicenseKey($key) {
    global $validLicenseKeys;
    
    // Check if the provided key is in the list of valid keys
    if (in_array($key, $validLicenseKeys)) {
        return true; // Key is valid
    } else {
        return false; // Key is invalid
    }
}

// Handle API requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the request contains a 'key' parameter
    if (isset($_POST['key'])) {
        $licenseKey = $_POST['key'];
        
        // Validate the license key
        $isValid = validateLicenseKey($licenseKey);
        
        // Prepare JSON response
        $response = [
            'success' => true,
            'message' => $isValid ? 'License key is valid!' : 'Invalid license key.'
        ];
    } else {
        // Invalid request format
        $response = [
            'success' => false,
            'message' => 'Invalid request format. Missing license key.'
        ];
    }
    
    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} else {
    // Handle unsupported request methods
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed.']);
    exit;
}
?>
