<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title><?php
        echo isset($page_title) ? "{$page_title} : " : '';
        echo (class_exists('Settings_lib') ? settings_item('site.title') : 'Direccion de inmuebles');
        ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo(isset($meta_description) ? $meta_description : ''); ?>">
    <meta name="author" content="<?php echo(isset($meta_author) ? $meta_author : ''); ?>">
    <link rel="shortcut icon" href="<?php echo site_url(); ?>favicon.ico">
    <link rel="stylesheet" href="<?= base_url('assets/styles/theme.css') ?>">  
    <link rel="stylesheet" href="<?= base_url('assets/styles/style.css') ?>">  
    <link rel="stylesheet" href="<?= base_url('assets/styles/helpers/login.css') ?>">  
    <script type="text/javascript" src="<?= base_url('assets/js/jquery-2.0.3.min.js') ?>"></script>
</head>
<body class="login-page">
    <noscript>
        <div class="global-site-notice noscript">
            <div class="notice-inner">
                <p>
                    <strong>JavaScript seems to be disabled in your browser.</strong><br>You must have JavaScript enabled in
                    your browser to utilize the functionality of this website.
                </p>
            </div>
        </div>
    </noscript>
    <div class="page-back">
        <div class="contents">
            <?php echo isset($content) ? $content : Template::content(); ?>
        </div>
    </div>
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.cookie.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/login.js') ?>"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            localStorage.clear();
            var hash = window.location.hash;
            if (hash && hash != '') {
                $("#login").hide();
                $(hash).show();
            }
        });
    </script>
</body>
</html>