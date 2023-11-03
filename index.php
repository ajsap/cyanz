<?php
/**
 * index.php
 *
 * The main entry point for the CYA.NZ URL shortening service. This file contains the
 * front-end form that users interact with to shorten their URLs. It's designed with
 * Bootstrap for a responsive user interface and utilizes YOURLS as the back end for
 * URL management and analytics. Google reCAPTCHA v3 is integrated to protect against
 * automated abuse.
 *
 * Before using, please configure the following:
 * - Set your Google reCAPTCHA keys where marked 'XXXXXX'.
 * - Configure the YOURLS API endpoint with your domain and signature token.
 * - Update any other service-specific configuration as needed.
 * - Ensure the dependency files `cya_header.php`, `cya_footer.php`, and `cya.php`
 *   are present and configured as per your requirements.
 *
 * @author Andy Saputra
 * @link https://cya.nz/
 * @copyright 2023 Andy Saputra
 * @license MIT License
 * @version 1.0
 *
 * @tested on PHP 7.4.33
 * @tested with YOURLS 1.9.2
 *
 * Instructions:
 * - Replace 'XXX' with your actual data.
 * - Ensure all dependencies are installed and properly configured.
 * - Ensure the files `cya_header.php`, `cya_footer.php`, and `cya.php` are in the
 *   same directory as `index.php` and are accessible.
 *
 * This file is part of the CYA.NZ URL shortener.
 *
 * Released under the MIT License.
 */

include 'cya_header.php'; ?>

<main>
    <div class="container">
        <form id="url-shorten-form" action="cya.php" method="post">
            <!-- Hidden field for reCAPTCHA -->
            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">

            <div class="form-group">
                <label for="url">Enter URL:</label>
                <input type="url" class="form-control" id="url" name="url" required>
            </div>

            <div class="form-group">
                <label for="customKeyword">Custom Keyword (Optional):</label>
                <input type="text" class="form-control" id="customKeyword" name="keyword">
            </div>

            <button class="btn btn-primary" type="submit">Shorten</button>
        </form>
    </div>
</main>

<?php include 'cya_footer.php'; ?>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.getElementById('url-shorten-form').addEventListener('submit', function(event) {
        event.preventDefault();
        grecaptcha.ready(function() {
            grecaptcha.execute('XXXXXX', {action: 'submit'}).then(function(token) {
                document.getElementById('recaptchaResponse').value = token;
                event.target.submit();
            });
        });
    });
</script>
