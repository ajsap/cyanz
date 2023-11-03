/**
 * Footer template for CYA.NZ
 *
 * This footer file is used to close the HTML structure of the pages and provide consistent footer content and scripts across the cya.nz URL shortening service website.
 *
 * @author Andy Saputra
 * @link https://cya.nz/
 * @copyright 2023 Andy Saputra
 * @license MIT License
 * @version 1.0
 *
 * The footer includes copyright statement, and loads the Bootstrap JavaScript library.
 * Ensures a uniform footer presentation and functional script loading for the website.
 *
 * @tested on PHP 7.4.33
 * @tested with YOURLS 1.9.2
 *
 * Lovingly crafted in Auckland, New Zealand.
 */

<footer class="footer mt-auto py-3">
    <div class="container text-center">
        <span class="text-muted">
            Copyright &copy; 2015-<?php echo date("Y"); ?>, CYA.NZ. All Rights Reserved<br />Lovingly made in Auckland, New Zealand
        </span>
    </div>
</footer>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
