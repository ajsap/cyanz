<?php
/**
 * Core processing script for CYA.NZ
 *
 * This script handles the main functionality of the CYA.NZ URL shortening service. It includes the reCAPTCHA verification to prevent abuse, interfaces with the YOURLS API to shorten URLs, and provides the user with the result.
 *
 * @author Andy Saputra
 * @link https://cya.nz/
 * @copyright 2023 Andy Saputra
 * @license MIT License
 * @version 1.0
 *
 * The script processes the input from the form, verifies the reCAPTCHA response, and then makes a request to the YOURLS API. Upon receiving the response, it either displays the shortened URL or an error message.
 *
 * @tested on PHP 7.4.33
 * @tested with YOURLS 1.9.2
 *
 * Usage Instructions:
 * - Substitute the placeholders 'XXXXXX' with your actual Google reCAPTCHA secret key and YOURLS API signature token.
 * - Confirm that the YOURLS API endpoint and the corresponding $signature_token 'XXXXXX' accurately match your API file location.
 *
 * Security notes:
 * - The reCAPTCHA v3 secret key and the YOURLS signature token are critical security elements. By including your YOURLS signature token in this script, it is not exposed to the public.
 * - Ensure that this file (and any other files containing sensitive keys) is properly secured and not accessible to unauthorized individuals.
 *
 * Dependencies:
 * - cya_header.php: Provides the header HTML structure and includes meta, title, and scripts.
 * - cya_footer.php: Closes the HTML structure and provides footer content.
 * - index.php: Serves as the initial user interface where users input URLs to be shortened; `cya.php` is triggered from here.
 *
 * The script also utilises PHP cURL to make the API requests and requires the cURL module to be enabled in your PHP environment.
 */

// Include header
include('cya_header.php');

// Verify the reCAPTCHA response
$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
$recaptcha_secret = 'XXXXXX'; // Your secret key
$recaptcha_response = $_POST['recaptcha_response'];

// Make and decode POST request
$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
$recaptcha = json_decode($recaptcha);

if ($recaptcha->score >= 0.5) {
    // Verified - Proceed with YOURLS API request
    $url_to_shorten = $_POST['url'];
    $custom_keyword = $_POST['keyword'];

    // YOURLS API endpoint and the signature token
    $yourls_api_endpoint = 'https://cya.nz/yourls-api.php'; // Replace with your domain
    $signature_token = 'XXXXXX'; // Replace with your actual signature token

    // Prepare the data for YOURLS
    $data = array(
        'url' => $url_to_shorten,
        'keyword' => $custom_keyword,
        'format' => 'json',
        'action' => 'shorturl',
        'signature' => $signature_token
    );

    // Initiate a CURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $yourls_api_endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    // Forward the client's IP address
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "X-Forwarded-For: " . $_SERVER['REMOTE_ADDR']
    ));
    
    $result = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($result, true);

    // Output the short URL in the middle of the page
    echo "<div class='container' style='text-align: center; padding: 20px;'>";
    if (isset($response['status']) && $response['status'] === 'success') {
        echo "<div class='input-group mb-3'>";
        echo "<input id='shortUrl' type='text' class='form-control' value='{$response['shorturl']}' readonly>";
        echo "<div class='input-group-append'>";
        echo "<button class='btn btn-outline-secondary' type='button' onclick='copyToClipboard()'>Copy</button>";
        echo "</div>";
        echo "</div>";
        // Home Button with tooltip
        echo "<a href='index.php' class='btn btn-primary' role='button' data-toggle='tooltip' data-placement='top' title='Shorten another URL'>Home</a>";
        echo "<script>
                $(function () {
                    $('[data-toggle=\"tooltip\"]').tooltip();
                });

                function copyToClipboard() {
                    var copyText = document.getElementById('shortUrl');
                    copyText.select();
                    document.execCommand('copy');
                    alert('Shortened URL copied to clipboard: ' + copyText.value);
                }
              </script>";
    } else {
        echo isset($response['message']) ? $response['message'] : 'An error occurred.';
    }
    echo "</div>";

} else {
    // Not verified - show form error
    echo "<p class='error'>CAPTCHA verification failed. Please try again.</p>";
}

// Include footer
include('cya_footer.php');
?>
