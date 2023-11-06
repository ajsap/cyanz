<?php
/**
 * CYA.NZ URL Shortening Service - Header Template
 *
 * The header template for the CYA.NZ URL shortening service, which includes
 * essential meta tags, site title, and Bootstrap framework for styling. This file
 * should be included at the beginning of each page to maintain consistent branding
 * and functionality across the site.
 *
 * @author Andy Saputra
 * @link https://cya.nz/
 * @copyright 2023 Andy Saputra
 * @license MIT License
 * @version 1.1
 *
 * @tested on PHP 7.4.33
 * @tested with YOURLS 1.9.2
 *
 * Instructions:
 * - Replace the placeholder 'XXXXXX' with your personal Google reCAPTCHA site key.
 * - Ensure the Bootstrap CDN link is correct and functional.
 * - Update the header content like title and description as needed.
 *
 * Dependencies:
 * - Bootstrap 4.5.2 CSS
 * - Google reCAPTCHA API
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Experience fast, secure, and easy-to-use URL shortening with CYA.NZ – your trusted New Zealand-based service that ensures swift link shortening with advanced spam protection. Ideal for enhancing your digital presence." />
    <title>Reliable URL Shortening Service - CYA.NZ</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js?render=XXXXXX"></script>
    <style>
        body { padding-top: 50px; }
        .container { max-width: 600px; }
    </style>
</head>
<body>
<header class="text-center my-4">
    <h1>CYA.NZ</h1>
    <p>Reliable URL Shortening Service</p>
</header>
