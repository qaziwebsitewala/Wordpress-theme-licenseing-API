<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>License Validation</title>
</head>
<body>

    <h1>License Key Validation</h1>
    <form action="" method="post">
        <label for="license_key">Enter your license key:</label><br>
        <input type="text" id="license_key" name="license_key" required><br><br>
        <input type="submit" name="submit" value="Validate License">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $licenseKey = $_POST['license_key'];
		//var_dump($licenseKey); // Output response for debugging
        // API URL for license validation
        $apiUrl = 'http://localhost/blockFY/wp-content/themes/blockfly/LicenseKey-Api/license-validation.php';

        // Create cURL request
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['license_key' => $licenseKey]));

        // Execute cURL request
        $response = curl_exec($ch);

        if ($response === false) {
            echo 'cURL Error: ' . curl_error($ch);
        } else {
            $result = json_decode($response, true);
           // var_dump($result); // Output API response for debugging

            if ($result && isset($result['valid']) && $result['valid'] === true) {
                echo '<p style="color: green;">License key is valid!</p>';
                // Further logic or actions for a valid license
            } else {
                echo '<p style="color: red;">Invalid license key. Please try again.</p>';
                // Display error message or handle invalid license
            }
        }

        curl_close($ch);
    }
    ?>

</body>
</html>
